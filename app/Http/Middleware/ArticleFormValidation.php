<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleFormValidation
{
    public function handle(Request $request, Closure $next)
    {
        if($request->segment(4) == "duzenle" ){
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required|min:10',
                    'category' => 'required',
                    'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=300,min_height=300',
                    'content' => 'required|min:50'
                ],
            );
        }else{
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required|min:10',
                    'category' => 'required',
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=300,min_height=300',
                    'content' => 'required|min:50'
                ],
            );
        }


        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        
        return $next($request);
    }
}
