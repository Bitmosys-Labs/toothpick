<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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
        $allowedOrigins = [
            'https://practice.toothpickdentalstaff.com',
            'https://dcp.toothpickdentalstaff.com',
            'https://test.toothpickdentalstaff.com',
            'http://localhost:3000',
            'https://confident-hugle-261d64.netlify.app',
        ];
        try {
            $origin = $_SERVER['HTTP_ORIGIN'];
        }catch(\Exception $e){
            $origin = "*";
        }
        if (in_array($origin, $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', "GET, POST, OPTIONS")
                ->header('Access-Control-Allow-Headers', "Accept,Authorization,Content-Type,x-xsrf-token,Cookie")
                ->header('Access-Control-Allow-Credentials', 'true');
        }
        return $next($request);
    }
}
