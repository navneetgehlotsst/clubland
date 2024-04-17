<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class JWTMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user) {
                return response()->json(['status'=> false ,'message'=> "Invalid authorization token", 'data' => new \stdClass()], 400);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status'=> false ,'message'=> "Invalid authorization token", 'data' => new \stdClass()], 400);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status'=> false ,'message'=> "Authorization token expired", 'data' => new \stdClass()], 400);                
            }else {
                return response()->json(['status'=> false ,'message'=> "Missing Authorization Token", 'data' => new \stdClass()], 400);
            }
        }
        return $next($request);
    }
}
