<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Review;
class ReviewController extends Controller
{
    public function index(){

        // order by created_at desc must coz fornt edd show form this
        $reviews = Cache::rememberForever('all-reviews',function() {
            return Review::with('product','user')->orderBy('created_at','DESC')->get();
        });

      
        return view('admin.review.index',compact('reviews'));
    }

    public function show($id){
        $review = Review::find($id);
    
    	return view('admin.review.show',compact('review'));
    }

    public function add(){
    	return view('admin.review.add');
    }

    public function edit($id){
    	return view('admin.review.edit');
    }

    public function store(Request $r){

        // delete cache reviews
        $this->delete_all_reviews_cache();
    	return back()->with('success','review Stored')->route('admin.index');
    }

    public function delete(Request $r){

        Review::find($r->id)->delete();


        // delete cache reviews
        $this->delete_all_reviews_cache();

    	return response()->json([
            'message' => "Review Deleted"
        ]);
    }

    public function active(Request $r){
        $review = Review::find($r->id);


        if($review->active == 1){
            $review->active = 0;
            $review->save();

            // delete cache reviews
            $this->delete_all_reviews_cache();

            return response()->json([
                'message' => "Review DActivated"
            ]);
        }else{
            $review->active = 1;
            $review->save();

            // delete cache reviews
            $this->delete_all_reviews_cache();

            return response()->json([
                'message' => "Review Activated"
            ]);
        }

    }




    public function delete_all_reviews_cache(){
        Cache::forget('all-reviews');
    }


}
