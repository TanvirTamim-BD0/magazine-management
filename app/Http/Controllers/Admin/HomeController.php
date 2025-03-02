<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Task;
use App\Models\Client;
use App\Models\Notice;

class HomeController
{
    public function index()
    {
        $categoryCount = Category::count();
        $totalTasks = Task::count();
	    $pendingTasks = Task::where('status', 'pending')->count();
	    $completedTasks = Task::where('status', 'completed')->count();
	    $todaysTasks = Task::whereDate('created_at', today())->count(); 
	    $pendingTasks = Task::where('status', 'pending')->count();
	    $completedTasks = Task::where('status', 'completed')->count();
	    $totalClients = Client::count();
	    $notices = Notice::count(); 
	    $noticeFirst = Notice::latest()->first();
        return view('home',compact('categoryCount','totalTasks','pendingTasks','completedTasks','todaysTasks','pendingTasks','totalClients','notices','noticeFirst'));
    }
}
