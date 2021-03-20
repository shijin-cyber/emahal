<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffDesignation;
use App\PaymentType;
use Auth;
use DataTables;

class SettingsController extends Controller
{
    public function index()
    {
    	return view('settings.settings_list');
    }

    public function saveDesignation(Request $request)
    {
    	$request->validate([
    		'designation' => 'required|string',
    		'edit_id' => 'required',
    	]);

    	if($request->edit_id == 0)
	    	$designation = new StaffDesignation;
	    else
	    	$designation = StaffDesignation::find($request->edit_id);

    	$designation->user_id 	= Auth::user()->id;
    	$designation->type_name = $request->designation;
    	return $designation->save() ? response()->json(['status' => true, 'message' => '', 200]) : response()->json(['status' => false, 'message' => ''], 402);
    }

    public function savePaymentType(Request $request)
    {
    	$request->validate([
    		'payment_type_name' => 'required|string',
    		'edit_id' => 'required',
    	]);

    	if($request->edit_id == 0)
	    	$paymentType = new PaymentType;
	    else
	    	$paymentType = PaymentType::find($request->edit_id);

    	$paymentType->user_id 	= Auth::user()->id;
    	$paymentType->type_name = $request->payment_type_name;
    	return $paymentType->save() ? response()->json(['status' => true, 'message' => ''], 200) : response()->json(['status' => false, 'message' => ''], 402);
    }

    public function getPaymentTypes(Request $request)
    {
    	if ($request->ajax()) {
            $data = PaymentType::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                       $btn = '<a href="javascript:void(0);" class="edit btn btn-primary btn-sm edit-payment-type" data-value="'.$row->id.'"><i class="fa fa-pencil"></i> Edit</a>';
                       $btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="edit btn btn-danger delete-payment btn-sm" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return response()->json(['status' => false], 402);
    }

    public function getStaffDesignations(Request $request)
    {
        if ($request->ajax()) {
            $data = StaffDesignation::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit-staff-designation" data-value="'.$row->id.'"><i class="fa fa-pencil"></i> Edit</a>';
                       $btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="edit btn btn-danger btn-sm delete-staff-designation" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return response()->json(['status' => false], 402);
    }

    public function getSingleStaffDesignation(Request $request)
    {
        if($request->ajax()) {
            $designation = StaffDesignation::where('id', $request->id)->first();
            return isset($designation->id) ? response()->json(['status' => true, 'data' => $designation], 200) : response()->json(['status' => false, 'data' => $designation], 402);
        }
        return response()->json(['status' => false], 402);
    }

    public function getSinglePaymentType(Request $request)
    {
        if($request->ajax()) {
            $paymentType = PaymentType::where('id', $request->id)->first();
            return isset($paymentType->id) ? response()->json(['status' => true, 'data' => $paymentType], 200) : response()->json(['status' => false, 'data' => $paymentType], 402);
        }
        return response()->json(['status' => false], 402);
    }

    public function deletePaymentType(Request $request)
    {
        if($request->ajax())
        {
            return PaymentType::find($request->id)->delete() ? response()->json(['status' => true], 200) : response()->json(['status' => false], 402);
        }
        return response()->json(['status' => false], 402);
    }

    public function deleteStaffDesignation(Request $request)
    {
        if($request->ajax())
        {
            return StaffDesignation::find($request->id)->delete() ? response()->json(['status' => true], 200) : response()->json(['status' => false], 402);
        }
        return response()->json(['status' => false], 402);
    }
}