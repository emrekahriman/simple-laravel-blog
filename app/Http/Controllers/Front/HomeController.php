<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\SendContact;
// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        // Tum view'lere page'leri gonderiyoruzs
        view()->share('pages', Page::whereStatus(1)->orderBy('order', 'ASC')->get());
        view()->share('setting', Setting::find(1));
    }

    public function index()
    {
        $data = [
            'categories' => Category::whereStatus(1)->get(),
            'articles' => Article::whereHas('category', function ($query) {
                $query->whereStatus(1);
            })->whereStatus(1)->orderBy('created_at', 'DESC')->limit(5)->get(),
            'popularArticles' =>Article::whereHas('category', function ($query) {
                $query->whereStatus(1);
            })->whereStatus(1)->orderBy('hit', 'DESC')->limit(2)->get(),
        ];
        return view('front.home', $data);
    }

    
    public function category($slug)
    {
        $category = Category::whereStatus(1)->whereSlug($slug)->first() ?? abort(404, 'Böyle bir kategori bulunamadı!');
        $data = [
            'category' => $category,
            'categories' => Category::whereStatus(1)->get(),
            'articles' => Article::whereStatus(1)->whereCategoryId($category->id)->orderBy('created_at', 'DESC')->paginate(5),
        ];
        return view('front.category', $data);
    }


    public function singleArticle($category, $slug)
    {
        $category = Category::whereStatus(1)->whereSlug($category)->first() ?? abort(404, 'Böyle bir kategori bulunamadı!');
        $article = Article::whereStatus(1)->whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(404, 'Böyle bir yazı bulunamadı!');
        
        // Sayfaya her girildiginde goruntulenme sayisini bir arttir
        $article->increment('hit');
        
        $data = [
            'article' => $article,
        ];
        return view('front.singlePost', $data);
    }


    public function page($slug)
    {
        $page = Page::whereStatus(1)->whereSlug($slug)->first() ?? abort(404, 'Böyle bir sayfa bulunamadı!');
        $data = [
            'page' => $page,
            'pages' => Page::whereStatus(1)->orderBy('order', 'ASC')->get(),

        ];
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactPost(Request $request)
    {
        //dd($request->post());
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'topic' => $request->topic,
            'message' => $request->message,
        ]);

        // Mail gonder
        Mail::to('fake@mail.com')->send(new SendContact($request->name, $request->email, $request->topic, $request->message));

        return back()->with('msg', 'Mesajınız başarıyla gönderildi!');
    }


    public function maintenance()
    {
        if (Setting::find(1)->active == 1) {
            return redirect()->route('home');
        }
        return view('front.maintenance');
    }


}
