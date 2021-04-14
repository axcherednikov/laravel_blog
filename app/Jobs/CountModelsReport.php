<?php

namespace App\Jobs;

use App\Exports\Export;
use App\Mail\ReportsCreate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CountModelsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public array $models, public string $emailUser) { }

    public function handle()
    {
        Mail::to($this->emailUser)
            ->send(new ReportsCreate($this->generateMessage(), $this->generatePathFile()));
    }

    private function generateMessage(): string
    {
        $string = '';

        foreach ($this->models as $model => $name) {
            $string .= $name . ' ' . $model::all()->count() . '<br>';
        }

        return $string;
    }

    private function generatePathFile(): array
    {
        $pathToFiles = [];

        foreach ($this->models as $modes => $name) {
            $pathToFiles[] = Excel::download(new Export($modes), $name . '_отчёт.xlsx')->getFile()->getPathname();
        }

        return $pathToFiles;
    }
}
