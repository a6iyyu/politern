<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemovePageOne
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->query('page') == 1) return redirect()->to($request->url() . '' . http_build_query($request->except('page')));
        return $next($request);
    }
}