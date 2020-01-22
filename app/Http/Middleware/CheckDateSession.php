<?php

namespace App\Http\Middleware;

use Closure;

class CheckDateSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('date') === null) {
            session([
                'date' => [
                    'initial_date' => strtotime(date('Y-m-d')),
                    'final_date' => strtotime(date('Y-m-t'))
                ]
            ]);
        }

        return $next($request);
    }
}
