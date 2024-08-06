<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;

    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Admin Created')
                    ->view('emails.admin_created')
                    ->with('admin', $this->admin);
    }
}
