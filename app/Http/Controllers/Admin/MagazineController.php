<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Designation;
use App\Models\Company;
use App\Models\Magazine;
use Auth;
use Carbon\Carbon;

class MagazineController extends Controller
{
    public function clientMagazine($id)
    {
    	$clientData = Client::where('id',$id)->first();
    	$magazineData = Magazine::orderBy('id','desc')->get();
    	return view('admin.client.magazine',compact('clientData','magazineData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['date'] = Carbon::now()->toDateString();

        if($request->image != ''){
	            $file = $request->file('image');
	            $fileName = time().'.'.$file->getClientOriginalExtension();
	            $destinationPath = public_path('uploads/magazine/');
	            $file->move($destinationPath,$fileName);
	            $data['image'] = $fileName;
        	}
        
        if(Magazine::create($data)){
            return redirect()->back()->with('message','Successfully Magazine Added');
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $magazineData = Magazine::find($id);

        if($request->image != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/magazine/');
            if(file_exists($destinationPath.$magazineData->image)){
                if($magazineData->image != ''){
                    unlink($destinationPath.$magazineData->image);
                }
            }

            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
       		 }

        if($magazineData->update($data)){
            return redirect()->back()->with('message','Successfully Magazine Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }
    }

    public function destroy($id)
    {
        $magazineData = Magazine::find($id);
        if($magazineData->delete()){

            return redirect()->back()->with('message','Successfully Magazine Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }  

    public function magazineSend($id)
    {
    	$magazineData = Magazine::where('id',$id)->first();
    	$magazineData->status = 'Send';
    	$magazineData->save();
    	return redirect()->back()->with('message','Successfully Magazine Send');

    } 


}
