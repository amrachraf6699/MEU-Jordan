<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Program;
use App\Models\Research;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = auth()->user();

        $users_count = User::count();
        $departments_count = Department::count();
        $programs_count = Program::count();
        $researches_count = Research::count();
        $my_reserches_count = $user->researches->count();

        $my_department_researches_count = Research::whereHas('user', function($query) use ($user) {
            $query->where('department_id', $user->department_id);
        })->count();

        $departments = Department::all();
        $programs = Program::all();

        $isProfileComplete = $user->full_name && $user->employee_number && $user->role && $user->department_id && $user->program_id && $user->username;

        return view('dashboard.home', compact('users_count',
        'departments_count',
        'programs_count',
        'researches_count',
        'departments',
        'user','programs',
        'isProfileComplete',
        'my_reserches_count',
        'my_department_researches_count'));
    }

}
