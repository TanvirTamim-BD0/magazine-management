<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magazine;
use Auth;
use Carbon\Carbon;

class MagazineController extends Controller
{
    public function index()
    {   
        $magazineData = Magazine::orderBy('id','desc')->get();
        return view('admin.magazine.index',compact('magazineData'));
    }

    public function create()
    {
        return view('admin.magazine.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if($request->image != ''){
	            $file = $request->file('image');
	            $fileName = time().'.'.$file->getClientOriginalExtension();
	            $destinationPath = public_path('uploads/magazine/');
	            $file->move($destinationPath,$fileName);
	            $data['image'] = $fileName;
        	}
        
        if(Magazine::create($data)){
            return redirect()->route('admin.magazine.index')->with('message','Successfully Magazine Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $magazineData = Magazine::where('id',$id)->first();
        return view('admin.magazine.edit',compact('magazineData'));
    }

    public function update(Request $request,$id){

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
            return redirect(route('admin.magazine.index'))->with('message','Successfully Magazine Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $magazineData = Magazine::find($id);
        if($magazineData->delete()){

            return redirect(route('admin.magazine.index'))->with('message','Successfully Magazine Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
