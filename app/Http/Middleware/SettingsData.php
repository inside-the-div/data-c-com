<?php

namespace App\Http\Middleware;

use Closure;

use App\Settings;
use App\Slider;
use App\Category;
use Session;
class SettingsData
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
        
        if(!Session::has('settings')){

            $settings = Settings::find(1);
            
            Session::put('settings','1');
            Session::put('title',$settings->title);
            Session::put('logo',$settings->logo);
            Session::put('fev_icon',$settings->fev_icon);
            Session::put('description',$settings->description);
            Session::put('tag',$settings->tag);
            Session::put('email',$settings->email);
            Session::put('phone',$settings->phone);
            Session::put('facebook',$settings->facebook);
            Session::put('linkedin',$settings->linkedin);
            Session::put('youtube',$settings->youtube);
            Session::put('instagram',$settings->instagram);
            Session::put('facebook_messenger',$settings->facebook_messenger);

            Session::put('copyright',$settings->copyright);
            Session::put('address',$settings->address);
            Session::put('location',$settings->location);
            
          

            $categories = Category::all();
            Session::put('categories',$categories);
        }

        if(!Session::has('cart-products')){
            $products = array();

            Session::put('cart-products',$products);
        }

        
        return $next($request);
    }
}
