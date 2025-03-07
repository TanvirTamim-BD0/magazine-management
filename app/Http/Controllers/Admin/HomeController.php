<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Task;
use App\Models\Client;
use App\Models\Notice;
use Auth;

class HomeController
{
    public function index()
    {
        
    	if(Auth::user()->role == 'Admin'){
            $totalTasks = Task::count();
            $pendingTasks = Task::where('status', 'pending')->count();
		    $completedTasks = Task::where('status', 'completed')->count();
		    $todaysTasks = Task::whereDate('created_at', today())->count(); 
		    $totalClients = Client::count();
        }elseif(Auth::user()->role == 'User'){
            $totalTasks = Task::where('user_id',Auth::user()->id)->count();
            $pendingTasks = Task::where('user_id',Auth::user()->id)->where('status', 'pending')->count();
		    $completedTasks = Task::where('user_id',Auth::user()->id)->where('status', 'completed')->count();
		    $todaysTasks = Task::where('user_id',Auth::user()->id)->whereDate('created_at', today())->count(); 
        }else{
            $taskData = [];
        }

        $totalClients = Client::count();
	    $notices = Notice::count(); 
	    $noticeFirst = Notice::latest()->first();
        return view('home',compact('totalTasks','pendingTasks','completedTasks','todaysTasks','pendingTasks','totalClients','notices','noticeFirst'));
    }
}
