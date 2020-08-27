<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckCustomer
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

        $user_type = Session::get('type');

        if($user_type == 'customer'){
            return $next($request);
        }else{
            return redirect('/');
        }
       
    }
}
