@extends('dashboard.layouts.app')
@section('title', 'إنشاء مستخدم جديد')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>إنشاء مستخدم جديد</h6>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <!-- Create User Form -->
                <form action="{{ route('dashboard.users.store') }}" method="POST">
                    @csrf

                    <div class="row p-4">
                        <!-- Full Name Field -->
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">الإسم الكامل</label>
                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}">
                            @error('full_name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username Field -->
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">اسم المستخدم</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                            @error('username')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employee Number Field -->
                        <div class="col-md-6 mb-3">
                            <label for="employee_number" class="form-label">الرقم الوظيفي</label>
                            <input type="number" name="employee_number" class="form-control" value="{{ old('employee_number') }}">
                            @error('employee_number')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Field -->
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">الرتبة</label>
                            <select name="role" class="form-control">
                                <option value="">اختر الرتبة</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>مستخدم</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مدير نظام</option>
                                <option value="committee_member" {{ old('role') == 'committee_member' ? 'selected' : '' }}>عضو لجنة</option>
                            </select>
                            @error('role')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department Field -->
                        <div class="col-md-6 mb-3">
                            <label for="department_id" class="form-label">القسم</label>
                            <select name="department_id" class="form-control">
                                <option value="">اختر القسم</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Program Field -->
                        <div class="col-md-6 mb-3">
                            <label for="program_id" class="form-label">البرنامج</label>
                            <select name="program_id" class="form-control">
                                <option value="">اختر البرنامج</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="d-flex justify-content-center mt-2 mb-2">
                                <button type="submit" class="btn btn-primary me-2">إضافة المستخدم</button>

                                <a href="{{ route('dashboard.users.import') }}" class="btn btn-secondary">استيراد من Excel</a>
                            </div>
                            <small class="form-text text-muted mt-2 p-2 border border-2 border-round border-rounded">كلمة المرور الافتراضية هي الرقم الوظيفي</small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
