<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {   
        $taskData = Task::orderBy('id','desc')->get();
        return view('admin.task.index',compact('taskData'));
    }

    public function create()
    {   
        $userData = User::all();
        return view('admin.task.create',compact('userData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['assign_date'] = Carbon::now()->toDateString();
        
        if(Task::create($data)){
            return redirect()->route('admin.task.index')->with('message','Successfully Task Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $taskData = Task::where('id',$id)->first();
        $userData = User::all();
        return view('admin.task.edit',compact('taskData','userData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $taskData = Task::find($id);
        if($taskData->update($data)){
            return redirect(route('admin.task.index'))->with('message','Successfully Task Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $taskData = Task::find($id);
        if($taskData->delete()){

            return redirect(route('admin.task.index'))->with('message','Successfully Task Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
