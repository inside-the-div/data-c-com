<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
class CustomUserController extends Controller
{
    public function index(){


        $admins = User::where('type','=','admin')->where('permissions','!=','all')->get();


    	return view('admin.user.index',compact('admins'));
    }

    public function show($id){
    	return view('admin.user.show');
    }

    public function add(){
    	return view('admin.user.add');
    }

    public function edit($id){

        $user = User::find($id);
        $permission_str = $user->permissions;
        $permissions =  explode(",",$permission_str);

    	return view('admin.user.edit',compact('user','permissions'));
    }

    public function store(Request $r){
        $default_permission = "admin.home,admin.dashboard,admin.profile,admin.profile.update,admin.profile.password_change";


        $r->validate([
            'name'     => 'required',
            'email'     => 'required|unique:users',
            'password'    => 'required|min:8',
            'permission'  => 'required'
 
        ]);

        $user = new User;

        $user->name = $r->name;
        $user->email = $r->email;
        $user->un_hash_password = $r->password;
        $user->password = Hash::make($r->password);
        $user->type = 'admin'; // default
        $user->permission_description = "adsf";

        
        $user->designation = $r->designation;

        // make a string of all permission route name 
        $all_premission = $default_permission;
        foreach ($r->permission as  $permission) {
           $all_premission .=','.$permission;
        }
        
        $user->permissions =  $all_premission;
        $user->save();

    
    	return back()->with('success','user Stored');
    }

    public function delete(Request $r){
    	$user = User::find($r->id);
        $user->delete();

        return response()->json([
           'message' => "User Delete Success"
        ]);

    }

    public function update(Request $r){

        // dd($r->permission);

            $user  = User::find($r->id);
    	    
            $r->validate([
                'name'     => 'required',
                'permission'  => 'required'
        
            ]);

           
            $user->name = $r->name;

            $user->permission_description = $r->description;
            $user->designation = $r->designation;

            // make a string of all permission route name 
            $all_premission = "";
            foreach ($r->permission as  $permission) {
               $all_premission .=','.$permission;
            }
            

            // dd($all_premission);

            $user->permissions =  $all_premission;

            $user->save();

        
            return back()->with('success','user Stored');
    }
    public function deactivated(){
    	return back()->with('success','user Deactivated');
    }
}
