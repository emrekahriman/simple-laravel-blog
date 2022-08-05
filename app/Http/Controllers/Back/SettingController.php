<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = [
            'setting' => Setting::find(1),
        ];
        return view('back.setting.index', $data);
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);

        $setting->title = $request->title;
        $setting->active = $request->active;
        $setting->description = $request->description;
        $setting->keywords = $request->keywords;
        $setting->author = $request->author;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->github = $request->github;
        $setting->linkedin = $request->linkedin;
                
        if ($request->hasFile('logo')) {
            $logo = 'logo.png';
            $request->logo->move(public_path('uploads'),  $logo);
            // db update
            $setting->logo = "uploads/" . $logo;
        }

        if ($request->hasFile('favicon')) {
            $favicon = 'favicon.png';
            $request->favicon->move(public_path('uploads'),  $favicon);
            // db update
            $setting->favicon = "uploads/" . $favicon;
        }

        $setting->save();  // execute query

        toastr()->success('Güncelleme işlemi tamamlandı!', 'Başarılı');
        return back();
    }

}
