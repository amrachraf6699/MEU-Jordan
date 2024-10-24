<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Imports\UsersImport;
use App\Models\Department;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UsersController extends Controller
{
    public function index(Request $request)
    {

        $departments = Department::all();
        $programs = Program::all();

        $query = User::query();

        if($request->filled('search'))
        {
            $query->where('full_name', 'like', "%{$request->search}%")
                ->orWhere('username', 'like', "%{$request->search}%");
        }

        if($request->filled('department_id'))
        {
            $query->where('department_id', $request->department_id);
        }

        if($request->filled('program_id'))
        {
            $query->where('program_id', $request->program_id);
        }

        if($request->filled('role'))
        {
            $query->where('role', $request->role);
        }

        $users = $query->where('id', '!=', auth()->id())->latest()->with(['department' , 'program'])->withCount('researches')->paginate(10);

        return view('dashboard.users.index', compact('users', 'departments', 'programs'));
    }

    public function create()
    {
        $departments = Department::all();
        $programs = Program::all();

        return view('dashboard.users.create', compact('departments', 'programs'));
    }

    public function store(CreateUserRequest $request)
    {
        $request['password'] = $request->employee_number;

        $user = User::create($request->all());

        return redirect()->route('dashboard.users.index')->with('success', 'تمت إضافة المستخدم بنجاح');
    }

    public function import()
    {
        return view('dashboard.users.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ], [
            'file.required' => 'حقل الملف مطلوب',
            'file.mimes' => 'يجب أن يكون الملف من نوع xlsx, csv, xls',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->route('dashboard.users.index')->with('success' , 'تم استيراد المستخدمين بنجاح');

    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $programs = Program::all();

        return view('dashboard.users.edit', compact('user', 'departments', 'programs'));
    }

    public function update(EditUserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('dashboard.users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function export(Request $request)
    {
        $format = $request->input('format');

        if ($format == 'excel') {
            return Excel::download(new UsersExport, 'مستخدمين النظام.xlsx');
        } elseif ($format == 'pdf') {
            $users = User::with(['department', 'program', 'researches'])->get()->map(function ($user) {
                return [
                    'full_name' => $user->full_name,
                    'username' => $user->username,
                    'employee_number' => $user->employee_number,
                    'role' => $this->getRoleLabelInArabic($user->role),
                    'department' => $user->department->name ?? 'غير محدد',
                    'program' => $user->program->name ?? 'غير محدد',
                    'researches_count' => $user->researches->count() ?: '-',
                ];
            });

            $pdf = Pdf::loadView('dashboard.pdf.users', compact('users'));
            return $pdf->download('مستخدمين النظام.pdf');
        }

        return redirect()->back()->with('error', 'تنسيق غير صالح');
    }









    private function getRoleLabelInArabic($role)
    {
        switch ($role) {
            case 'admin':
                return 'مشرف نظام';
            case 'committee_member':
                return 'عضو لجنة';
            case 'user':
                return 'مستخدم';
            default:
                return 'غير معروف';
        }
    }
}
