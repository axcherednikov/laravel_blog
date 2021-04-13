<?php

namespace App\Mail;

class ReportsCreate extends AbstractEmails
{
    public function __construct(public string $reports) { }

    public function build()
    {
        return $this->markdown('mail.reports');
    }
}
