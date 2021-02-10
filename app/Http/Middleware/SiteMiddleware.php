<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Http\Request;

class SiteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(is_null(auth()->user()->status) || auth()->user()->status == 'rejected'){
            return redirect()->route('forbidden');
        }
        $categories = Category::orderBy('created_at', 'DESC')->get();
        View()->share(['categories' => $categories]);
        return $next($request);
    }
}
