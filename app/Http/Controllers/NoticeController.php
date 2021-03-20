<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\User;
use App\Notifications\NoticeNotification;
use Auth;
use DataTables;
use Notification;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Notice::where('user_id', Auth::user()->id)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                       $btn = '<a href="'.url('edit-notice/'.$row->id).'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>';
                       $btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="edit btn btn-danger delete-notice btn-sm" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
                        return $btn;
                    })
                    ->editColumn('date', function($row){
                    	if($row->date == null || $row->date == '')
                    		return '';
                    	$date = \DateTime::createFromFormat('Y-m-d', $row->date);
                    	return $date->format('d/m/Y');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    	}
    	// $user = Auth::user();
    	// Notification::send($user, new NoticeNotification());
    	return view('notice.notice_list');
    }
    public function addNotice()
	{
		return view('notice.add_notices');
	}
	public function editNotice($id)
	{
		$notice = Notice::where('id', $id)->first();
		return view('notice.add_notices', ['notice' => $notice]);
	}
	public function saveNotice(Request $request)
	{
		$this->validate($request, [
			"title" => 'required',
			"date" => 'nullable',
			"place" => 'nullable',
			"description" => 'required'
		]);

		if($request->edit_id == '0')
			$notice = new Notice;
		else
			$notice = Notice::find($request->edit_id);

		$notice->user_id 		= Auth::user()->id;
		$notice->title 			= $request->title;
		$notice->description 	= $request->description;
		$notice->date 			= $request->date;
		$notice->place 			= $request->place;
		$status = $notice->save();
		if($status && $request->edit_id == '0')
		{
			$user = User::all();
	    	Notification::send($user, new NoticeNotification($notice));
		}
		if($request->ajax())
			return $status ? response()->json(['status' => true, 'message' => ''], 200) : response()->json(['status' => false, 'message' => ''], 402);
		else
			return $notice->save() ? redirect('notices')->with('success','Successfully saved your details !!') : redirect('notices')->with('error','Something went wrong. Please try again later !!');
	}
	public function deleteNotice(Request $request)
	{
		if($request->ajax())
		{
			return response()->json(['status' => Notice::where('id', $request->id)->delete()], 200);
		}
		return response()->json(['status' => false], 402);
	}
}