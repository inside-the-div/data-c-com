<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use App\User;
class EmailController extends Controller
{
	public function index(){
		$emails  = Email::orderBy('created_at','DESC')->get();

		return view('admin.email.index',compact('emails'));
	}

	public function replay(Request $r){


		$name 		= $r->name;
		$email 		= $r->email;
		$subject 	= $r->subject;
		$message 	= $r->message;


		return response()->json([
			'success' => 'Success'
		]);

	}
	public function send_page(){
		$users = User::all();

		return view('admin.email.send',compact('users'));
		
	}
	public function send(Request $r){


		$email 		= $r->email;
		$subject 	= $r->subject;
		$message 	= $r->message;


		return response()->json([
			'success' => 'Success'
		]);
	}
}
