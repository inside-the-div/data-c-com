<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

	

    public function billing(){
        return $this->hasOne('App\BillingDetail');
    }

    public function shipping(){
        
        return $this->hasOne('App\ShippingDetail');
    }
}
