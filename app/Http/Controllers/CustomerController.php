<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Address;
use App\CustomerProof;
use Auth;
use DataTables;

class CustomerController extends Controller
{   
	public function customer_view(){


		return view('customer.customer_view');
	}
	public function addCustomer()
	{
		$customers = Customer::where('user_id', Auth::user()->id)->get();
		return view('customer.add_customer', compact('customers'));
	}
	public function save_customer(Request $request) {
		// dd($request->hasFile('proof_image_1'));
	  	// return $request->file('image_name');
	  	if($request->edit_id == 0){
			$customer = new Customer;
			Address::where('customer_id', $request->edit_id)->delete();
	  	}
		else
			$customer = Customer::find($request->edit_id);
		$customer->user_id          = Auth::user()->id;
		$customer->parent_id  	    = $request->relation_name;
		$customer->full_name 		= $request->full_name;
		$customer->dob 				= $request->dob;
		$customer->email 			= $request->email;
		$customer->phone 			= $request->phone;
		$customer->is_head 			= $request->is_head == 1;
		$customer->relation_name 	= $request->relation_name;
		$customer->description 		= $request->description;
		$customer->save();

		foreach ($request->address_type as $key => $value) {
			$customeradd 				= new Address;
			$customeradd->customer_id  	= $customer->id;
			$customeradd->user_id  	    = Auth::user()->id;
			$customeradd->type 			= $request->address_type[$key];
			$customeradd->street 		= $request->street[$key];
			$customeradd->post_name 	= $request->post_name[$key];
			$customeradd->pin_code 		= $request->pin_code[$key];
			$customeradd->district 		= $request->district[$key];
			$customeradd->state 		= $request->state[$key];
			$customeradd->save();
			if($request->permanent_check == 1) {
				$customeradd 				= new Address;
				$customeradd->type 			= 'permanent';
				$customeradd->customer_id  	= $customer->id;
				$customeradd->user_id  	    = Auth::user()->id;
				$customeradd->street 		= $request->street[$key];
				$customeradd->post_name 	= $request->post_name[$key];
				$customeradd->pin_code 		= $request->pin_code[$key];
				$customeradd->district 		= $request->district[$key];
				$customeradd->state 		= $request->state[$key];
				$customeradd->save();
			}
		}
		foreach ($request->proof_name as $key => $value) {
			if($request->proof_edit[$key] == 0){
				$customerproof = new CustomerProof;
			} else {
				$customerproof = CustomerProof::find($request->proof_edit[$key]);
			}

			$customerproof->customer_id  	= $customer->id;
			$customerproof->proof_name 		= $request->proof_name[$key];
			$customerproof->proof_number 	= $request->proof_number[$key];
			if ($files = $request->file('proof_image_'.($key + 1))) {
				$destinationPath 	= 'proof/';
				$proofFileName 		= date('YmdHis') .'_'.mt_rand(1000,9999)."_blog." . $files->getClientOriginalExtension();
				$files->move($destinationPath, $proofFileName);
				$customerproof->image_name = $proofFileName;
			}
			$customerproof->save();
		}
		 return redirect('customer');
	}
	public function getCustomersData(Request $request)
	{
		if ($request->ajax()) {
			$data = Customer::latest()->get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){
				$btn = '<a href="'.url('customer-edit/'.$row->id).'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>';
				$btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="edit btn btn-danger btn-sm delete-customer" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}
	}

	public function deleteCustomer(Request $request)
	{
		if($request->ajax())
		{
			return response()->json(['status' => @Customer::find($request->id)->delete()]);
		}
	}
	public function customer_edit($id){
		$customer  				= Customer::where('id',$id)->first();
		$address['permanent'] 	= Address::where('customer_id', $id)->where('type', 'permanent')->first();
		$address['contact'] 	= Address::where('customer_id', $id)->where('type', 'contact')->first();
		$proof 					= CustomerProof::where('customer_id', $id)->get();
		$customers 				= Customer::where('user_id', Auth::user()->id)->where('id', '!=', $id)->get();
		return view('customer.add_customer', compact('customer', 'customers', 'address', 'proof'));
	}
}






