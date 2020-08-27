<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAdmin
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

        // dd($request->path());

        $user_type = Session::get('type');
        if($user_type == 'admin'){
             return $next($request);
        }else{
            return redirect('/customer')->with('success','Welcome Back!!');
        }

        
    }
}
