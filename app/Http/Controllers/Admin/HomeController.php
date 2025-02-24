<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;

class HomeController
{
    public function index()
    {
        $categoryCount = Category::count();
        return view('home',compact('categoryCount'));
    }
}
