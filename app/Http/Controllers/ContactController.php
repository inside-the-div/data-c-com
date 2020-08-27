<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class ContactController extends Controller
{
    public function index(){
		return view('website.pages.contact');
	}


	public function edit(){
		return view('admin.pages.contact');
	}

	public function update(Request $r){
		dd($r);
	}

	public function SendEmail(Request $r){

		$input = [

			'name' => $r->name,
			'email' => $r->email,
			'subject' => $r->subject,
			'email_message' => $r->message

		];


		Mail::send('email.contact', $input, function($mail){
			$mail->from('contact@banatechai.com','Banate Chai')
				 ->to('nasirkhan.webdev@gmail.com','insideTheDiv')
				 ->subject('contact email');
		});

		return response()->json([
		   'message'=>'email send success'
		   
		]);
	}

	
}
