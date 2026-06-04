<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Jika ada redirect dengan session flash untuk notifikasi
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            $session = $request->session();
            
            if ($session->has('status') && $session->has('message')) {
                $status = $session->get('status');
                $message = $session->get('message');
                
                // Tambahkan parameter ke URL
                $response = $response->with('status', $status)
                                   ->with('message', $message);
            }
        }
        
        return $response;
    }
}
