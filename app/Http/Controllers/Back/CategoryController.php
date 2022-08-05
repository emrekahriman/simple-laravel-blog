<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    
    public function index()
    {
        $data = [
            'categories' => Category::orderBy('created_at', 'DESC')->get(),
        ];
        return view('back.categories.index', $data);
    }
    

    public function store(Request $request)
    {
        $isExist = Category::whereSlug(Str::slug($request->name))->first();
        if ($isExist) {
            toastr()->error($request->name . ' adında bir kategori mevcut!');
            return back();
        }
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        toastr()->success('Kategori başarıyla oluşturuldu.');
        return back();
    }


    public function switchStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->newState == 'true' ? 1 : 0;
        $category->save();
        return 1;
    }


    public function getCategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    
    public function update(Request $request)
    {
        $catIsExist = Category::whereNot('id', $request->id)->whereSlug(Str::slug($request->name))->first();
        
        if ($catIsExist) {
            toastr()->error('Bu isimde bir kategori zaten mevcut!');
            return back();
        }

        Category::findOrFail($request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        toastr()->success('Kategori başarıyla güncellendi.');
        return back();
    }


    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $articles = $category->articlesWithDisable;

        if ($articles->count() > 0) {  // Varsa eğer tüm makaleler ve görselleri silinir.
            foreach ($articles as $article) {
                $article->delete(); 
                if (File::exists($article->image)) {
                    File::delete(public_path($article->image));
                }
            }
            toastr()->success('Kategori ve kategoriye ait tüm makaleler (' . $articles->count() . ') başarıyla silindi!');

        }else{
            toastr()->success('Kategori başarıyla silindi.');

        }

        $category->delete();
        return 1;
    }

}
