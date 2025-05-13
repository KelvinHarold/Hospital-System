<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailMessages extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $Password;

    public function __construct($name, $phone, $Password)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->Password = $Password;
    }

    public function build()
    {
        return $this->subject('Welcome to MtotoClinic')
                    ->view('emails.user_registered');
    }
}
