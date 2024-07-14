<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $userCount = User::count();
        return view('pages.admin.dashboard', compact('userCount'));
    }


    public function user()
    {
        $data = "test";
        $courses = Course::all();
        return view('pages.user.dashboard.dashboard', compact('data', 'courses'));
    }
}
