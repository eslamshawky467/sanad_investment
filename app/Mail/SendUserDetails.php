<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserDetails extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $email;
    public $password;
    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;

    }
    public function build()
    {
        return $this->markdown('email.registeremail');
    }
}
