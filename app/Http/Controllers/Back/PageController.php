<?php

namespace App\Http\Controllers\Back;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{

    public function index()
    {
        $data = [
            'pages' => Page::orderBy('order')->get(),
        ];

        return view('back.pages.index', $data);
    }


    public function switchStatus(Request $request)
    {
        Page::findOrFail($request->id)->update([
            'status' => $request->newState == 'true' ? 1 : 0,
        ]);
        return 1;
    }


    public function create()
    {
        return view('back.pages.create');
    }

    
    public function store(Request $request)
    {

        $imageName = Str::slug($request->title . '-' . now()) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/pages'), $imageName);

        $lastOrder = Page::orderBy('order', 'DESC')->first();

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => 'uploads/pages/' . $imageName,
            'content' => $request->content,
            'order' => $lastOrder->order + 1,
        ]);

        toastr()->success('Sayfa başarıyla oluşturuldu', 'Başarılı');
        return redirect()->route('admin.pages.index');

    }


    public function edit($id)
    {
        $data = [
            'page' => Page::findOrFail($id),
        ];

        return view('back.pages.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        if ($request->hasFile('image')) {
            
            $imageName = Str::slug($request->title . '-' . now()) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/pages'), $imageName);

            if (!Str::startsWith($page->image, ['Http', 'http'])) {
                File::delete(public_path($page->image));
            }

            Page::whereId($id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => 'uploads/pages/' . $imageName,
                'content' => $request->content,
            ]);

        } else {
            Page::whereId($id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
            ]);
        }
        
        toastr()->success('Sayfa başarıyla güncellendi.', 'Başarılı!',);
        return redirect()->route('admin.pages.index');

    }


    public function delete($id)
    {
        $page = Page::findOrFail($id);

        if (File::exists($page->image)) {
            File::delete(public_path($page->image));
        }

        $page->delete();

        toastr()->success('Sayfa başarıyla silindi.', 'Başarılı');
        return back();
    }


    public function order(Request $request)
    {
        foreach ($request->get('order') as $order => $pageId) {
            Page::whereId($pageId)->update([
                'order' => $order,
            ]);
        }

        return 1;
    }
    
}
