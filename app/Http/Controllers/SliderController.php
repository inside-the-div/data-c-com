<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Slider;
use Auth;
class SliderController extends Controller
{
    public function index(){
    	
    	$sliders =  Cache::rememberForever('sliders', function () {
    		return Slider::with('user')->get();
    	});

		return view('admin.slider.index',compact('sliders'));
	}

	public function show($id){
		return view('admin.slider.show');
	}

	public function store(Request $r){
		$currentuserid = Auth::user()->id;

		$slider = new Slider;
		

		$img = time().'.'.$r->image->getClientOriginalExtension();
		$r->image->move(public_path('/assets/img/slider'), $img);

		$slider->image = $img;
		$slider->active = 0;
		$slider->user_id = $currentuserid;
		$slider->save();

		Cache::forget('sliders');
		return back()->with('success','slider Added');
	}

	public function delete(Request $r){

		$slider = Slider::find($r->id);


		$path = public_path('/assets/img/slider');
		if (File::exists($path.'/'.$slider->image)){
		      File::delete($path.'/'.$slider->image);
		}

		$slider->delete();


		Cache::forget('sliders');
		return response()->json([
		   'message' => "Success"
		]);
	}

	public function active(Request $r){


		$slider = Slider::find($r->id);
		Cache::forget('sliders');

		if($slider->active == 1){
			$slider->active = 0;
			$slider->save();
			return response()->json([
				'message' => "Success"
			]);
		}else{
			$slider->active = 1;
			$slider->save();

			return response()->json([
				'message' => "Success"
			]);
		}

		
	}


}
