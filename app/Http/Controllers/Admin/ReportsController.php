<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\CountModelsReport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReportsController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.reports.index');
    }

    public function total(): Factory|View|Application
    {
        $models = collect(trans('models'));

        return view('admin.reports.total', compact('models'));
    }

    public function generate(): RedirectResponse
    {
        $models = request()->input('reports_list');

        if ($models) {
            CountModelsReport::dispatch($models, auth()->user()->email);

            flash('После создания отчёт будет отправлен Вам на почту!');
        } else {
            flash('Выберите модели из списка для получения отчёта', 'warning');
        }

        return back();
    }
}
