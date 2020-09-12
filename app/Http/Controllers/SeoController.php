<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(){
    	return view('admin.seo.index');
    }

    public function show($id){
    	return view('admin.seo.show');
    }

    public function add(){
    	return view('admin.seo.add');
    }

    public function edit($id){
    	return view('admin.seo.edit');
    }

    public function store(Request $r){
    	return back()->with('success','seo Stored')->route('admin.index');
    }

    public function delete(Request $r){
    	return back()->with('success','seo Deleted')->route('admin.index');
    }

    public function active(Request $r){
    	return back()->with('success','seo Activated');
    }
    public function deactivated(){
    	return back()->with('success','seo Deactivated');
    }

}
