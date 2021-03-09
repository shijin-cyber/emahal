<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function address()
    {
    	return $this->belongsTo('App\Address','id','customer_id');
    }
    public function proof()
    {
    	return $this->belongsTo('App\CustomerProof','id','customer_id');
    }
}
