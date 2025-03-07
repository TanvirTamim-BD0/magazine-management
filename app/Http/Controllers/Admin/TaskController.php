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
        if(Auth::user()->role == 'Admin'){
            $taskData = Task::orderBy('id','desc')->get();
            $users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskData = Task::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskData = [];
            $users = [];
        }

        return view('admin.task.index',compact('taskData','users'));
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
            return redirect()->back()->with('message','Successfully Task Created');
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
            return redirect()->back()->with('message','Successfully Task Updated');
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

    public function taskCompleted($id)
    {
        $taskData = Task::where('id',$id)->first();
        $taskData->status = 'Completed';
        $taskData->save();
        return redirect()->back()->with('message','Successfully Task Completed');
    }

    public function monthly()
    {   
        if(Auth::user()->role == 'Admin'){
            $taskData = Task::whereMonth('created_at', Carbon::now()->month)->get();
            $users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskData = Task::where('user_id',Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskData = [];
            $users = [];
        }
        return view('admin.task.index',compact('taskData','users'));
    }

    public function today()
    {   
        if(Auth::user()->role == 'Admin'){
            $taskData = Task::whereDate('created_at', Carbon::today())->get();
            $users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskData = Task::where('user_id',Auth::user()->id)->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskData = [];
            $users = [];
        }
        return view('admin.task.index',compact('taskData','users'));
    }

    public function pending()
    {   
        if(Auth::user()->role == 'Admin'){
            $taskData = Task::where('status', 'Pending')->get();
            $users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskData = Task::where('user_id',Auth::user()->id)->where('status', 'Pending')->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskData = [];
            $users = [];
        }
        return view('admin.task.index',compact('taskData','users'));
    }

    public function completed()
    {   
        if(Auth::user()->role == 'Admin'){
            $taskData = Task::where('status', 'Completed')->get();
            $users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskData = Task::where('user_id',Auth::user()->id)->where('status', 'Completed')->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskData = [];
            $users = [];
        }
        return view('admin.task.index',compact('taskData','users'));
    }

    public function adminComment(Request $request,$id)
    {
        $taskData = Task::where('id',$id)->first();
        $taskData->admin_comment = $request->admin_comment;
        $taskData->save();
        return redirect()->back()->with('message','Successfully Admin Comment Updated');
    }
    
}
