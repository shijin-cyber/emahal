<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Address;
use App\CustomerProof;
use Auth;
use DataTables;
use App\User;
use Hash;

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
		$this->validate($request, [
			"full_name" => 'required',
			"dob" => 'required',
			'email' => 'required|email|unique:users,email',
			"phone" => 'required',
			"relation_name" => 'nullable',
			"gender" => 'required',
			'street' => 'required|array|min:1',
			'street.*' => 'required|string|max:255',
			'post_name' => 'required|array|min:1',
			'post_name.*' => 'required|string|max:255',
			'pin_code' => 'required|array|min:1',
			'pin_code.*' => 'required|string|max:255',
			'state' => 'required|array|min:1',
			'state.*' => 'required|string|max:255',
			'district' => 'required|array|min:1',
			'district.*' => 'required|string|max:255',
			'proof_name' => 'required|array|min:1',
			'proof_name.*' => 'required|string|max:255',
			'proof_number' => 'required|array|min:1',
			'proof_number.*' => 'required|string|max:255',
			// 'proof_image' => 'required|array',
			// 'proof_image.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'

		]);
		$customerProof = CustomerProof::where('customer_id', $request->edit_id)->count();
		if($customerProof == 0)
			foreach ($request->proof_name as $key => $value) {
				$request->validate(
					[
						'proof_image_'.($key+1) => 'required|image|mimes:jpeg,png,jpg|max:2048'
					]
				);
			}
			else
				foreach ($request->proof_name as $key => $value) {
					if($customerProof > ($key+1))
						$request->validate(
							[
								'proof_image_'.($key+1) => 'required|image|mimes:jpeg,png,jpg|max:2048'
							]
						);
				}

			if($request->edit_id == 0)
				$customer = new Customer;
			else {
				$customer = Customer::find($request->edit_id);
				Address::where('customer_id', $request->edit_id)->delete();
			}

			$customer->user_id          = Auth::user()->id;
			$customer->parent_id  	    = $request->relation_name;
			$customer->full_name 		= $request->full_name;
			$customer->dob 				= $request->dob;
			$customer->email 			= $request->email;
			$customer->phone 			= $request->phone;
			$customer->is_head 			= $request->is_head == 1;
			$customer->gender 			= $request->gender;
			// $customer->relation_name 	= $request->relation_name;
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
				
				$customerusr 				= new User;
				$customerusr->user_type 	= 'customer';
				$customerusr->email 		= $request->email;
				$customerusr->name 		= $request->full_name;
				$customerusr->password 	= Hash::make($this->createCustomerPassword($request->full_name, $request->phone));
				$customerusr->save();

				if($request->ajax())
					return response()->json(['status' => true]);
				else
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
			public function createCustomerPassword($name, $phone)
			{
				$name_first_4 = substr(trim($name), 0, 4);
				$phone_last_4 = substr(trim($phone), strlen(trim($phone)) - 4, strlen(trim($phone)));
				return $name_first_4.$phone_last_4;
			}
		}






