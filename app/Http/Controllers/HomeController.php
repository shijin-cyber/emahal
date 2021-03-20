<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PaymentType;
use App\StaffDesignation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->createSeeder();
        $user = Auth::user();
        return view('home')->with('notification', $user->notifications);
    }
    public function createSeeder()
    {
        $staffDesignation = StaffDesignation::where('user_id', Auth::user()->id)->count() <= 0;
        $paymentType = PaymentType::where('user_id', Auth::user()->id)->count() <= 0;
        if ($staffDesignation) {
            $seeder = new \StaffDesignationSeeder;
            $seeder->run(Auth::user()->id);
        }
        if ($paymentType) {
            $seeder = new \PaymentTypeSeeder;
            $seeder->run(Auth::user()->id);
        }
    }
}
