<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }



    public function products(){
    	return $this->belongsToMany('App\Product');
    }




	public function parent(){
		return $this->belongsTo('App\Category', 'parent_id');
	}

	public function childs(){
		return $this->hasMany('App\Category', 'parent_id');
	}


}
