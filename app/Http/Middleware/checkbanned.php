<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkbanned
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

        //to check if the credential of user is valid and (status of user is disabled and user not admin )
        if((auth()->check() && (auth()->user()->status == 0 && auth()->user()->id !== 1))){
            Auth::logout();

            //All objects bound to the session are removed.
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('failed', 'Your Account is suspended, please contact to the Admin.');

        }

        return $next($request);
    }
}
