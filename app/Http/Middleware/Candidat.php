<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Symfony\Component\HttpFoundation\Response;

class Candidat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->role_id === 2){

            return $next($request);
        }else {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Vous n\'avez pas les droits.',
            ]);
        }
        } 
}
