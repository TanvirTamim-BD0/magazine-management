<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;

class CompanyController extends Controller
{
    public function index()
    {   
        $companyData = Company::orderBy('id','desc')->get();
        return view('admin.company.index',compact('companyData'));
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(Company::create($data)){
            return redirect()->route('admin.company.index')->with('message','Successfully Company Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $companyData = Company::where('id',$id)->first();
        return view('admin.company.edit',compact('companyData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $companyData = Company::find($id);
        if($companyData->update($data)){
            return redirect(route('admin.company.index'))->with('message','Successfully Company Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $companyData = Company::find($id);
        if($companyData->delete()){

            return redirect(route('admin.company.index'))->with('message','Successfully Company Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
