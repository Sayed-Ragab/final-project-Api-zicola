<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
         $user = $request->user();
            
        if (! $user || ! Admin::where('id', $user->id)->exists()) {
            abort(403, 'Unauthorized.');
        }    
        return $next($request);
    
}
}