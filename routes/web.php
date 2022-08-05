<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/
Route::middleware('isAdminLogged')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('giris', [AuthController::class, 'login'])->name('login');
    Route::post('giris', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::middleware('verifyAdmin')->prefix('/admin')->name('admin.')->group(function () {  // middleware ile admin yoksa logine yonlendirildi
    Route::get('anasayfa', [DashboardController::class, 'index'])->name('dashboard');

    // Makaleler
    Route::get('makaleler/durum-guncelle', [ArticleController::class, 'switchStatus'])->name('articles.switchStatus');  // resource controller'dan once tanimlanmali
    Route::get('makaleler/{id}/sil', [ArticleController::class, 'delete'])->name('articles.delete');
    Route::get('makaleler/silinenler', [ArticleController::class, 'trashed'])->name('articles.trashed');
    Route::get('makaleler/{id}/kurtar', [ArticleController::class, 'recover'])->name('articles.recover');
    Route::get('makaleler/{id}/tamamen-sil', [ArticleController::class, 'hardDelete'])->name('articles.hardDelete');
    Route::resource('makaleler', ArticleController::class)->names([
        'index' => 'articles.index',
        'create' => 'articles.create',
        'edit' => 'articles.edit',
        'update' => 'articles.update',
    ]);
    Route::middleware('ArticleFormValidation')->post('makaleler/olustur', [ArticleController::class, 'store'])->name('articles.store');

    // Kategoriler
    Route::get('kategoriler', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('kategoriler/olustur', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('kategoriler/durum-guncelle', [CategoryController::class, 'switchStatus'])->name('categories.switchStatus');
    Route::get('kategoriler/bilgi', [CategoryController::class, 'getCategory'])->name('categories.getCategory');
    Route::post('kategoriler/duzenle', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('kategoriler/sil', [CategoryController::class, 'delete'])->name('categories.delete');


    // Sayfalar
    Route::get('sayfalar/', [PageController::class, 'index'])->name('pages.index');
    Route::get('sayfalar/olustur', [PageController::class, 'create'])->name('pages.create');
    Route::middleware('PageFormValidation')->post('sayfalar/olustur', [PageController::class, 'store'])->name('pages.store');
    Route::get('sayfalar/{id}/duzenle', [PageController::class, 'edit'])->name('pages.edit');
    Route::middleware('PageFormValidation')->post('sayfalar/{id}/duzenle', [PageController::class, 'update'])->name('pages.update');
    Route::get('sayfalar/{id}/sil', [PageController::class, 'delete'])->name('pages.delete');
    Route::get('sayfalar/durum-guncelle', [PageController::class, 'switchStatus'])->name('pages.switchStatus');
    Route::get('sayfalar/sirala', [PageController::class, 'order'])->name('pages.order');

    // Ayarlar
    Route::get('ayarlar', [SettingController::class, 'index'])->name('setting.index');
    Route::post('ayarlar/guncelle', [SettingController::class, 'update'])->name('setting.update');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');    
});





/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/bakim', [HomeController::class, 'maintenance'])->name('maintenance');

Route::middleware(['SiteIsActive'])->group(function () {
    Route::get('/',  [HomeController::class, 'index'])->name('home');
    Route::get('/kategori/{kategoriSlug}', [HomeController::class, 'category'])->name('category');
    Route::get('/iletisim', [HomeController::class, 'contact'])->name('contact');
    Route::middleware('contactValidate')->post('/iletisim', [HomeController::class, 'contactPost'])->name('contact.post');
    Route::get('/{kategoriSlug}/{slug}',  [HomeController::class, 'singleArticle'])->name('singleArticle');
    Route::get('/{slug}', [HomeController::class, 'page'])->name('page');    
});
