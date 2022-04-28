<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromCollection
{
    public function __construct(public string $model)
    {
    }

    public function collection()
    {
        return $this->model::all();
    }
}
