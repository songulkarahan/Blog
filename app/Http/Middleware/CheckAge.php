<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $age = 18)//böyle yaş parametresi eklediğimiz için web route kısmında middleware de parametre verebiliyoruz
    {
      if ($request->user()->age<$age) {
        abort(403);
      }
        return $next($request);
    }
}
