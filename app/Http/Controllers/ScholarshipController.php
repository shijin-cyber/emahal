<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Scholarship;
use DataTables;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Scholarship::where('user_id', Auth::user()->id)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                       $btn = '<a href="'.url('edit-notice/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>';
                       $btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-danger delete-notice btn-sm" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
                        return $btn;
                    })
                    ->addColumn('link_created', function($row) {
                    	$btn = "<a href='$row->link' target='_blank'>$row->link</a>";
                    	return $btn;
                    })
                    ->editColumn('last_date', function($row){
                    	if($row->last_date == null || $row->last_date == '')
                    		return '';
                    	$date = \DateTime::createFromFormat('Y-m-d', $row->last_date);
                    	return $date->format('d/m/Y');
                    })
                    ->rawColumns(['action', 'link_created'])
                    ->make(true);
    	}
    	return view('scholarship.scholarship_list');
    }
    public function addScholarship()
	{
    	return view('scholarship.add_scholarship');
	}
	public function editScholarship($id)
	{
		$scholarship = Scholarship::where('id', $id)->first();
		return view('scholarship.add_scholarship', ['scholarship' => $scholarship]);
	}
	public function saveScholarship(Request $request)
	{
		$this->validate($request, [
			"scholarship_name" => 'required',
			"link" => 'required|string',
			"last_date" => 'nullable|date',
			"description" => 'nullable|string'
		]);

		if($request->edit_id == '0')
			$scholarship = new Scholarship;
		else
			$scholarship = Scholarship::find($request->edit_id);

		$scholarship->user_id 		 	= Auth::user()->id;
		$scholarship->scholarship_name 	= $request->scholarship_name;
		$scholarship->link 	 			= $request->link;
		$scholarship->last_date 		= $request->last_date;
		$scholarship->description 		= $request->description;
		$scholarship->last_updated_by 	= Auth::user()->id;
		if($request->ajax())
			return $scholarship->save() ? response()->json(['status' => true, 'message' => ''], 200) : response()->json(['status' => false, 'message' => ''], 402);
		else
			return $scholarship->save() ? redirect('scholarships')->with('success','Successfully saved your details !!') : redirect('scholarships')->with('error','Something went wrong. Please try again later !!');
	}
	public function deleteScholarship(Request $request)
	{
		if($request->ajax())
		{
			return response()->json(['status' => Scholarship::where('id', $request->id)->delete()], 200);
		}
		return response()->json(['status' => false], 402);
	}
}
