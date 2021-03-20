<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use App\Notifications\EventNotification;
use DataTables;
use App\User;
use Notification;


class EventsController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Event::where('user_id', Auth::user()->id)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                       $btn = '<a href="'.url('edit-event/'.$row->id).'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>';
                       $btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="edit btn btn-danger delete-event btn-sm" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
                        return $btn;
                    })
                    ->editColumn('start_date', function($row){
                    	if($row->start_date == null || $row->start_date == '')
                    		return '';
                    	$date = \DateTime::createFromFormat('Y-m-d', $row->start_date);
                    	return $date->format('d/m/Y');
                    })
                    ->editColumn('start_time', function($row){
                    	if($row->start_time == null || $row->start_time == '')
                    		return '';
                    	$date = \DateTime::createFromFormat('H:i:s', $row->start_time);
                    	return $date->format('h:i A');
                    })
                    ->editColumn('end_date', function($row){
                    	if($row->end_date == null || $row->end_date == '')
                    		return '';
                    	$date = \DateTime::createFromFormat('Y-m-d', $row->end_date);
                    	return $date->format('d/m/Y');
                    })
                    ->editColumn('end_time', function($row){
                    	if($row->end_time == null || $row->end_time == '')
                    		return '';
                    	$date = \DateTime::createFromFormat('H:i:s', $row->end_time);
                    	return $date->format('h:i A');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
		return view('events.event_list');
	}
	public function addEvent()
	{
		return view('events.add_events');
	}
	public function editEvent($id)
	{
		$event = Event::where('id', $id)->first();
		return view('events.add_events', ['event' => $event]);
	}
	public function saveEvent(Request $request)
	{
		$this->validate($request, [
			"event_name" 		=> 'required',
			"event_image" 		=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
			"start_date" 		=> 'required',
			"start_time" 		=> 'nullable',
			"end_date" 			=> 'nullable',
			"end_time" 			=> 'nullable',
			"event_description" => 'nullable|string',
		]);

		if($request->edit_id == '0')
			$event = new Event;
		else
			$event = Event::find($request->edit_id);
		$event->user_id 			= Auth::user()->id;
		$event->event_name 			= $request->event_name;
		$event->event_description 	= $request->event_description;
		if($request->file('event_image') !== null)
		{
			$image 				= $request->file('event_image');
            $fileName 			= 'Event_'.time().'_'.mt_rand(1000, 9999).'.'.$image->getClientOriginalExtension();
            $destinationPath 	= public_path('/images/events');
            $image->move($destinationPath, $fileName);
			$event->image 		= $fileName;
		}
		$event->start_date 		= $request->start_date;
		$event->start_time 		= $request->start_time;
		$event->end_date 		= $request->end_date;
		$event->end_time 		= $request->end_time;
		$status = $event->save();
		if($status && $request->edit_id == '0')
		{
			$user = User::all();
	    	Notification::send($user, new EventNotification($event));
		}
		if($request->ajax())
			return $status ? response()->json(['status' => true, 'message' => ''], 200) : response()->json(['status' => false, 'message' => ''], 402);
		else
			return $status ? redirect('events')->with('success','Successfully saved your details !!') : redirect('events')->with('error','Something went wrong. Please try again later !!');
	}
	public function deleteEvent(Request $request)
	{
		if($request->ajax())
		{
			return Event::where('id', $request->id)->delete() ? response()->json(['status' => true], 200) : response()->json(['status' => false], 402);
		}
		return response()->json(['status' => false], 402);
	}
}