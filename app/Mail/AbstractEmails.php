<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

abstract class AbstractEmails extends Mailable
{
    use Queueable, SerializesModels;
}
