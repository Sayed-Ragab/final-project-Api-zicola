<?php

namespace App\Http\Middleware;

use App\Models\Admin_clinic;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminClinicMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
         $user = $request->user();
            
        if (! $user || ! Admin_clinic::where('id', $user->id)->exists()) {
            abort(403, 'Unauthorized.');
        return $next($request);
    }
}
}
