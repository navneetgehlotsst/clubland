<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckBankAccount
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
      if (Auth::check()) {
        
            if(auth()->user()->slug == request('username')){
                if(auth()->user()->stripe_account_status == 'active'){
                    return $next($request);
                }else{
                    return redirect()->route('check')->withError('Please add your Bank first and then click on the Company preview page.');
                }
            }else{
                return $next($request);
            }
            
        }else{
            return $next($request);
        }

        
    }
}
