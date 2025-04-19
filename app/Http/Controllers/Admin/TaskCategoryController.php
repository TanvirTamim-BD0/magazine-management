<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskCategory;
use Auth;

class TaskCategoryController extends Controller
{
    public function index()
    {   
        $categoryData = TaskCategory::orderBy('id','desc')->get();
        return view('admin.taskCategory.index',compact('categoryData'));
    }

    public function create()
    {
        return view('admin.taskCategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(TaskCategory::create($data)){
            return redirect()->route('admin.task-category.index')->with('message','Successfully Task Category Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $categoryData = TaskCategory::where('id',$id)->first();
        return view('admin.taskCategory.edit',compact('categoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $categoryData = TaskCategory::find($id);
        if($categoryData->update($data)){
            return redirect(route('admin.task-category.index'))->with('message','Successfully Task Category Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $categoryData = TaskCategory::find($id);
        if($categoryData->delete()){

            return redirect(route('admin.task-category.index'))->with('message','Successfully Task Category Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    

}
