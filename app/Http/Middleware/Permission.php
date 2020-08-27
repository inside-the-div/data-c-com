<?php

namespace App\Http\Middleware;
use Closure;
use Session;
class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        
        $permissions  = Session::get('permissions');

        // ---------- for owner / super admin 
        if(in_array('all', $permissions)){
            return $next($request);
        }
        // end 


        
        $this_request = $request->route()->getName();

        if(in_array($this_request, $permissions)){
            return $next($request);
        }else{
            return back()->with('success','have no permission');
        }

        


        // if($request->ajax()){
        //         return response()->json([
        //             'message' => "---------have no permission"
        //         ]);
        // }else{
        //     return back()->with('success','have no permission');
        // }

        
        
    }
}
