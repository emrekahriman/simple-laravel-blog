<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'articles' => Article::orderBy('created_at', 'DESC')->get(),
        ];
        return view('back.articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::orderBy('name')->get(),
        ];
        return view('back.articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = Str::slug($request->title . '-' . now()) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/articles'), $imageName);

        Article::create([
            'category_id' => $request->category,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => 'uploads/articles/' . $imageName,
        ]);
        
        toastr()->success('Makale başarıyla oluşturuldu.', 'Başarılı!',);
        return redirect()->route('admin.articles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $data = [
            'categories' => Category::orderBy('name')->get(),
            'article' => $article,
        ];
        return view('back.articles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title . '-' . now()) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/articles'), $imageName);

            if (!Str::startsWith($article->image, ['Http', 'http'])) {
                File::delete(public_path($article->image));
            }

            Article::whereId($id)->update([
                'category_id' => $request->category,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image' => 'uploads/articles/' . $imageName,
            ]);
        }else{
            Article::whereId($id)->update([
                'category_id' => $request->category,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
            ]);
            
        }

        toastr()->success('Makale başarıyla güncellendi.', 'Başarılı!',);
        return redirect()->route('admin.articles.index');
    }


    public function switchStatus(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->newState == 'true' ? 1 : 0;
        $article->save();
        return 1;
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        toastr()->success('Makale başarıyla çöp kutusuna taşındı.', 'Başarılı!',);
        return redirect()->route('admin.articles.index');
    }


    public function trashed()
    {
        $data = [
            'articles' => Article::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];

        return view('back.articles.trashed', $data);
    }

    public function recover($id)
    {
        Article::onlyTrashed()->findOrFail($id)->restore();
        toastr()->success('Makale başarıyla kurtarıldı.', 'Başarılı!',);
        return redirect()->route('admin.articles.trashed');
    }

    public function hardDelete($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        if (File::exists($article->image)) {
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Makale tamamen silindi.', 'Başarılı!',);
        return redirect()->route('admin.articles.trashed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
