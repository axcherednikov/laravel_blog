<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class XHProfMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        xhprof_enable(XHPROF_FLAGS_MEMORY + XHPROF_FLAGS_CPU);

        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        $xhprofData = xhprof_disable();

        include_once '/var/www/xhprof/xhprof_lib/utils/xhprof_lib.php';
        include_once '/var/www/xhprof/xhprof_lib/utils/xhprof_runs.php';

        $run_id = (new \XHProfRuns_Default())->save_run($xhprofData, str_replace(['/', '.'], '_', $request->path()));
    }
}
