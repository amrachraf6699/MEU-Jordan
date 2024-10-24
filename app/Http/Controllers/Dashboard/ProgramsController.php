<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('users')->paginate(10);
        return view('dashboard.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('dashboard.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:programs',
        ]);

        $program = Program::create([
            'name' => $request->name,
        ]);
        return redirect()->route('dashboard.programs.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Program $program)
    {
        return view('dashboard.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:programs,name,' . $program->id,
        ], [
            'name.required' => 'يرجى إدخال اسم البرنامج.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل.',
        ]);
    
        $program->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('dashboard.programs.index')->with('success', 'تم التعديل بنجاح');
    }
    
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('dashboard.programs.index')->with('success', 'تم الحذف بنجاح');
    }
}
