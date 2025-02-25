<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use Auth;

class DesignationController extends Controller
{
    public function index()
    {   
        $designationData = Designation::orderBy('id','desc')->get();
        return view('admin.designation.index',compact('designationData'));
    }

    public function create()
    {
        return view('admin.designation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(Designation::create($data)){
            return redirect()->route('admin.designation.index')->with('message','Successfully Designation Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $designationData = Designation::where('id',$id)->first();
        return view('admin.designation.edit',compact('designationData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $designationData = Designation::find($id);
        if($designationData->update($data)){
            return redirect(route('admin.designation.index'))->with('message','Successfully Designation Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $designationData = Designation::find($id);
        if($designationData->delete()){

            return redirect(route('admin.designation.index'))->with('message','Successfully Designation Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
