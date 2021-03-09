<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Madrassa;
use Auth;
use DataTables;
class MadarassaController extends Controller
{
    public function addMadarassa(){
    	return view('madarassa.add_madarassa');
    }
    
    public function save_madrasaa(Request $request){
      if($request->edit_id == 0){
			$savemadrassa = new Madrassa;
			}
		else
			$savemadrassa = Madrassa::find($request->edit_id);
    	
    	$savemadrassa->user_id          = Auth::user()->id;
    	$savemadrassa->madrassa_name = $request->madrassa_name;
    	$savemadrassa->reg_id = $request->reg_id;
    	$savemadrassa->estd = $request->estd;
    	$savemadrassa->description = $request->description;
    	$savemadrassa->save();
    	return redirect('madrassa');


    }
    public function madrassa_view(){
    	return view('madarassa.madrassa_view');
    }
    public function getMadarassaData(Request $request){
    	 // dd($data);
    	if ($request->ajax()) {
			$data = Madrassa::latest()->get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){
				$btn = '<a href="'.url('madrassa-edit/'.$row->id).'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>';
				$btn .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="edit btn btn-danger btn-sm delete-madrassa" data-value="'.$row->id.'"><i class="fa fa-trash"></i> Delete</a>';
				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}

    }
    public function madrassa_edit($id){
    	$madrassa  				= Madrassa::where('id',$id)->first();
    	// return($madrassa);
    	return view('madarassa.add_madarassa',compact('madrassa'));

    }
    public function deleteMadrasa(Request $request)
	{
		if($request->ajax())
		{
			return response()->json(['status' => @Madrassa::find($request->id)->delete()]);
		}
	}
}
