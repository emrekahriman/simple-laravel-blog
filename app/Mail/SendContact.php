<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;
    public $name, $email, $topic, $message;


    public function __construct($name, $email, $topic, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->topic = $topic;
        $this->message = $message;
    }


    public function build()
    {
        return $this->from('info@blog.com')->markdown('front.mail.template');
    }
}
