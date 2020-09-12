<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class CacheControl extends Controller
{
    public function clear_cache(){
    	Cache::flush();

    	return response()->json([
    		'message' => 'Success'
    	]);
    }
}
