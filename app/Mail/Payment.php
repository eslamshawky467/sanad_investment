<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Payment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
public $balance;
public $amount;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($balancing,$amount)
    {
        $this->balance = $balancing;
        $this->amount = $amount;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.send_payment');
    }
}
