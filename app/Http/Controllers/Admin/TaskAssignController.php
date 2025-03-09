<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskAssign;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Karim007\LaravelSslwirlessSms\Facade\SslWirlessSms;

class TaskAssignController extends Controller
{
    public function index()
    {   
        if(Auth::user()->role == 'Admin'){
            $taskAssignData = TaskAssign::orderBy('id','desc')->get();
        	$users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskAssignData = TaskAssign::where('assign_to',Auth::user()->id)->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskAssignData = [];
            $users = [];
        }

        return view('admin.taskAssign.index',compact('taskAssignData','users'));
    }

    public function IAssignedTask()
    {   
        if(Auth::user()->role == 'Admin'){
            $taskAssignData = TaskAssign::orderBy('id','desc')->get();
        	$users = User::orderBy('id','desc')->get();
        }elseif(Auth::user()->role == 'User'){
            $taskAssignData = TaskAssign::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
            $users = User::orderBy('id','desc')->get();
        }else{
            $taskAssignData = [];
            $users = [];
        }

        return view('admin.taskAssign.index',compact('taskAssignData','users'));
    }


    public function create()
    {   
        $userData = User::all();
        return view('admin.taskAssign.create',compact('userData'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if($assign = TaskAssign::create($data)){

            $assignToData = User::where('id',$assign->assign_to)->first();
            $assignByData = User::where('id',$assign->user_id)->first();

            $phone_number = $assignToData->phone; // msisdn must be array
            $messageBody = 'Dear '.$assignToData->name.', You have been assigned a new task. Please review the details Your Dashboard: Please complete the task on time and update your progress accordingly. Best regards, '.$assignByData->name.'';

            $customer_smsId = uniqid();
            SslWirlessSms::singleSms($phone_number,$messageBody,$customer_smsId);

            return redirect()->back()->with('message','Successfully Task Assign Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $taskAssignData = TaskAssign::where('id',$id)->first();
        $userData = User::all();
        return view('admin.taskAssign.edit',compact('taskAssignData','userData'));
    }

    public function update(Request $request,$id){

        $data = $request->all();
    
        $taskAssignData = TaskAssign::find($id);
        if($taskAssignData->update($data)){
            return redirect()->back()->with('message','Successfully Task Assign Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $taskAssignData = TaskAssign::find($id);
        if($taskAssignData->delete()){

            return redirect()->back()->with('message','Successfully Task Assign Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    

    public function taskAssignCompleted($id)
    {
        $taskData = TaskAssign::where('id',$id)->first();
        $taskData->status = 'Completed';
        $taskData->save();
        return redirect()->back()->with('message','Successfully Task Assign Completed');
    }

    public function replyComment(Request $request,$id)
    {
        $taskData = TaskAssign::where('id',$id)->first();
        $taskData->reply_comment = $request->reply_comment;
        $taskData->save();
        return redirect()->back()->with('message','Successfully Reply Comment Updated');
    }

}
