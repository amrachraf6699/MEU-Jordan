<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
        $departments = Department::withCount('users')->paginate(10);
        return view('dashboard.Departments.index', compact('departments'));
    }

    public function create()
    {
        return view('dashboard.Departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
        ], [
            'name.required' => 'يرجى إدخال اسم القسم.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل.',
        ]);

        $Department = Department::create([
            'name' => $request->name,
        ]);
        return redirect()->route('dashboard.departments.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Department $Department)
    {
        return view('dashboard.Departments.edit', compact('Department'));
    }

    public function update(Request $request, Department $Department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $Department->id,
        ], [
            'name.required' => 'يرجى إدخال اسم القسم.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل.',
        ]);

        $Department->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.departments.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Department $Department)
    {
        $Department->delete();

        return redirect()->route('dashboard.departments.index')->with('success', 'تم الحذف بنجاح');
    }
}
