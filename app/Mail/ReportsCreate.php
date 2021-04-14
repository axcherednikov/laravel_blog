<?php

namespace App\Mail;

class ReportsCreate extends AbstractEmails
{
    public function __construct(public string $reports, public array $pathToFile) { }

    public function build()
    {
        $message = $this->markdown('mail.reports');

        for ($i = 0; $i < count($this->pathToFile); $i++) {
            $message->attach($this->pathToFile[$i]);
        }

        return $message;
    }
}
