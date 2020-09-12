<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

use App\Email;

class PageController extends Controller
{
    public function about_page(){
       
        return view('public.pages.about');
    }


    public function condition_page(){

       

    	return view('public.pages.condition');
    }


    public function privacy_page(){

     

    	return view('public.pages.privacy');
    }   


    public function contact_page(){
    	return view('public.pages.contact');
    }

    public function help_page(){
        
        return view('public.pages.help');
    }

    public function faq_page(){

        return view('public.pages.faq');
    }




    public function email_send(Request $r){



        $e = new Email;
        $e->name = $r->name;
        $e->email = $r->email;
        $e->phone = $r->phone;
        $e->subject = $r->subject;
        $e->message = $r->message;
        $e->save();


        return response()->json([
            'message' => 'Success'
        ]);
    }


   
}
