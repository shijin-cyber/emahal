<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;

class NikahController extends Controller
{
    public function nikah_registration(){

    	$customers = Customer::where('user_id', Auth::user()->id)->get();
    		// dd($customers, Auth::user()->id);
    	return view('nikah.registration', compact('customers'));
    }
}
