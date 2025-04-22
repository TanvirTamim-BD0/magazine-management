<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaCode;
use Auth;

class AreaCodeController extends Controller
{
    public function index()
    {   
        $areaCodeData = AreaCode::orderBy('name', 'asc')->get();
        return view('admin.areaCode.index',compact('areaCodeData'));
    }

    public function create()
    {
        return view('admin.areaCode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(AreaCode::create($data)){
            return redirect()->route('admin.area-code.index')->with('message','Successfully Area Code Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $areaCodeData = AreaCode::where('id',$id)->first();
        return view('admin.areaCode.edit',compact('areaCodeData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $areaCodeData = AreaCode::find($id);
        if($areaCodeData->update($data)){
            return redirect(route('admin.area-code.index'))->with('message','Successfully Area Code Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $areaCodeData = AreaCode::find($id);
        if($areaCodeData->delete()){

            return redirect(route('admin.area-code.index'))->with('message','Successfully Area Code Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
