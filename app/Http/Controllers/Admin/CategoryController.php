<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {   
        $categoryData = Category::orderBy('id','desc')->get();
        return view('admin.category.index',compact('categoryData'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(Category::create($data)){
            return redirect()->route('admin.category.index')->with('message','Successfully Category Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $categoryData = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('categoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $categoryData = Category::find($id);
        if($categoryData->update($data)){
            return redirect(route('admin.category.index'))->with('message','Successfully Category Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $categoryData = Category::find($id);
        if($categoryData->delete()){

            return redirect(route('admin.category.index'))->with('message','Successfully Category Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
