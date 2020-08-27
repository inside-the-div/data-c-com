<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Settings;
use App\Ecommerce;
use App\User;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
class SettingsController extends Controller
{


	public function index(){
		$settings = Settings::find(1);
		$ecommerce = Ecommerce::find(1);
		return view('admin.settings.index',compact('settings','ecommerce'));
	}


	public function update(Request $r){
		
		$settings = Settings::find(1);

		$old_logo = $settings->logo;
		$old_fev_icon = $settings->fev_icon;



		$r->validate([
	
		    'email' => 'required',
		    'phone' => 'required',
		    'copyright' => 'required',
		    'address' => 'required'
		    
		]);


		if ($r->hasFile('logo')){
			$r->validate([
			    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
			]);
			$del = 0;
			if(Storage::delete($old_logo)){
				$del = 1;
			}

			$path = public_path('/assets/img/website');
			if (File::exists($path.'/'.$old_logo)){
			    File::delete($path.'/'.$old_logo);
			}


			
			$this_logo = 'logo_'.time().'.'.$r->logo->getClientOriginalExtension();
			$r->logo->move(public_path('/assets/img/website'), $this_logo);

			$settings->logo = $this_logo;


		}

		if ($r->hasFile('fev_icon')){
			$r->validate([
			    'fev_icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
			]);
		


			$path = public_path('/assets/img/website');
			if (File::exists($path.'/'.$old_fev_icon)){
			    File::delete($path.'/'.$old_fev_icon);
			}

			$this_fev_icon = 'fev_icon_'.time().'.'.$r->fev_icon->getClientOriginalExtension();
			$r->fev_icon->move(public_path('/assets/img/website'), $this_fev_icon);

			$settings->fev_icon = $this_fev_icon;


		}


		$settings->email 		= $r->email;
		$settings->phone 		= $r->phone;
		$settings->copyright 	= $r->copyright;
		$settings->address 		= $r->address;



		
		$settings->save();
		Session::forget('settings');
		return back()->with('success','Success');

	}




	public function seo_update(Request $r){

		$settings = Settings::find(1);

		$r->validate([
		    'title' => 'required',
		    'tag' => 'required',
		    'description' => 'required'
		]);

		$settings->title = $r->title;
		$settings->tag = $r->tag;
		$settings->description = $r->description;


		$settings->save();
		Session::forget('settings');
		return back()->with('success','Success');
		
	}

	public function social_media_update(Request $r){


		$settings = Settings::find(1);




		$settings->facebook 	= $r->facebook;
		$settings->youtube 		= $r->youtube;
		$settings->linkedin 	= $r->linkedin;
		$settings->instagram 	= $r->instagram;

		$settings->save();
		Session::forget('settings');
		return back()->with('success','Success');
	}


	public function profile(){
		
		return view('admin.profile.show');
	}



	public function user_profile_update(Request $r){
		$user = User::find($r->id);

		// dd($user);
		$user->name = $r->name;
		$user->phone = $r->phone;
		$user->website = $r->website;
		$user->about = $r->about;
		$user->address = $r->address;


		$old_profile = $user->image;


		if ($r->hasFile('image')){


			// dd($user);

			
			$r->validate([
			    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
			]);
			$del = 0;
			if(Storage::delete($old_profile)){
				$del = 1;
			}
			$new_image = $r->image->store('public/images/user');
			$user->image = $new_image;
		}


		$user->save();
		return back()->with('success','Success');

	}



	public function password_change(Request $r){
		

		$user = User::find($r->id);



		$r->validate([
			'new_password' => 'required|min:8',
			'confirm_new_password' => 'required|min:8',
		]);


		if($r->new_password != $r->confirm_new_password){
			return back()->withErrors(['password' => ['Please use same password']]);
		}

		

		if(!Hash::check($r->old_password, $user->password)){
			return back()->withErrors(['password' => ['Wrong password']]);
		}

		$user->password = Hash::make($r->new_password);
		$user->un_hash_password = $r->new_password;
		$user->save();

		return back()->with('success','Success');



	}












    public function clear_cache(){

    	\Artisan::call('cache:clear');
    	return back()->with('success','Everything Updated!!');
    }
}
