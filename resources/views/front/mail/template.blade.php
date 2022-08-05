@component('mail::message')

<strong>Ad Soyad:</strong> {{ $name}}


<strong>E-Mail:</strong> {{ $email}}


<strong>Konu:</strong> {{ $topic}}


<strong>Mesaj:</strong> {{ $message}}
 
@component('mail::button', ['url' => 'https://github.com/Emrekhrmn'])
    Buraya Tıkla
@endcomponent


@endcomponent