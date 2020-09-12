<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

	public function user(){
		return $this->belongsTo('App\User');
	}


    public function categories(){
    	return $this->belongsToMany('App\Category');
    }

    public function sells(){
        return $this->hasMany('App\ProductSell','product_id');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }
}
