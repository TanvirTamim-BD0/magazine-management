<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Designation;
use App\Models\Company;
use Auth;
use App\Models\AreaCode;
use App\Models\Category;

class ClientController extends Controller
{
    public function index()
    {   
        $clientData = Client::orderBy('id','desc')->get();
        $companies = Company::all();
        $areas = AreaCode::all();
        $categories = Category::all();
        $designations = Designation::all();
        return view('admin.client.index',compact('clientData','companies','areas','categories','designations'));
    }

    public function create()
    {	
    	$designationData = Designation::all();
    	$companyData = Company::all();
        $areaCodeData = AreaCode::all();
        $categoryData = Category::all();
        return view('admin.client.create',compact('designationData','companyData','areaCodeData','categoryData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(Client::create($data)){
            return redirect()->route('admin.client.index')->with('message','Successfully Client Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $clientData = Client::where('id',$id)->first();
        $designationData = Designation::all();
    	$companyData = Company::all();
        $areaCodeData = AreaCode::all();
        $categoryData = Category::all();
        return view('admin.client.edit',compact('clientData','designationData','companyData','areaCodeData','categoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $clientData = Client::find($id);
        if($clientData->update($data)){
            return redirect(route('admin.client.index'))->with('message','Successfully Client Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $clientData = Client::find($id);
        if($clientData->delete()){

            return redirect(route('admin.client.index'))->with('message','Successfully Client Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    


    public function clientDataExport()
    {
        $clientData = Client::orderBy('id','desc')->get();
        $companies = Company::all();
        $areas = AreaCode::all();
        $categories = Category::all();
        $designations = Designation::all();
        return view('admin.client.clientReport',compact('clientData','companies','areas','categories','designations'));
    }

    public function areaFilter(Request $request)
    {
        $clientData = Client::where('area_code',$request->area_code)->orderBy('id','desc')->get();
        return view('admin.client.clientReport',compact('clientData'));
    }

}
