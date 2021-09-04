<?php

namespace App\Jobs;

use App\Events\CreateAdminReport;
use App\Exports\Export;
use App\Mail\ReportsCreate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CountModelsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const NAME_TRANS_FILE = 'models';

    public function __construct(public array $models, public string $emailUser)
    {
    }

    public function handle()
    {
        event(new CreateAdminReport($this->generateMessage()));

        Mail::to($this->emailUser)
            ->send(new ReportsCreate($this->generateMessage(), $this->generatePathFile()));
    }

    private function generateMessage(): string
    {
        $string = '';

        foreach ($this->models as $model) {
            $string .= $this->getNameModel($model) . ': ' . $model::count() . '<br>';
        }

        return $string;
    }

    private function generatePathFile(): array
    {
        $pathToFiles = [];

        foreach ($this->models as $model) {
            $pathToFiles[] = Excel::download(new Export($model), $this->getNameModel($model) . '.xlsx')
                ->getFile()
                ->getPathname();
        }

        return $pathToFiles;
    }

    private function getNameModel($model): array|string|Translator|Application|null
    {
        return trans(self::NAME_TRANS_FILE . '.' . $model);
    }
}
