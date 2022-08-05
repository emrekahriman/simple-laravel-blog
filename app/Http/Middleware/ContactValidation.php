<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContactValidation
{

    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make(
            $request->post(),
            [
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', ],
            'topic' => ['required'],
            'message' => ['required', 'min:20']
            ],
            /* -> lang/tr/validation dosyasında attributes array kısmında tanımlama yapıldı. ihtiyac yok
            [
                'required' => 'Lütfen :attribute alanını doldurun.',
                'email' => 'Lütfen :attribute alanına geçerli bir mail girin..',
                'min' => 'Çok kısa! :attribute alanı en az :min karakter olmalı.',
            ]
            */
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        return $next($request);
    }

}
