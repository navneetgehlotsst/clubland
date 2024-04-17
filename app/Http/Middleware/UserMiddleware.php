<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //dd(Auth::user());
        if(Auth::check()) {
            $user = Auth::user();
            if($user->status == '1'){
                if($user->role != "admin") {
                    return $next($request);
                }else{
                    return back()->withInput()->withError("Opps! You do not have access this");
                }
            }else{
             return redirect()->route('login_business');

            }
            
        }else{
            return redirect()->route('login_business');
        }
    }
}
