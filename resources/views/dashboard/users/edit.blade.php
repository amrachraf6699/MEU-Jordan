@extends('dashboard.layouts.app')
@section('title', 'تعديل بيانات ' . $user->full_name)
@section('content')
<div class="row">
    <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
      <div class="card z-index-0">
        <div class="card-body">
          <form role="form text-left" action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="page" value="{{ request('page') }}">

            <!-- Full Name -->
            <div class="mb-3">
              <label for="full_name" class="form-label">الاسم الكامل</label>
              <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Full Name" value="{{ old('full_name', $user->full_name) }}" required>
              @error('full_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Employee Number -->
            <div class="mb-3">
                <label for="employee_number" class="form-label">الرقم الوظيفي</label>
                <input type="text" name="employee_number" class="form-control @error('employee_number') is-invalid @enderror" placeholder="الرقم الوظيفي" value="{{ old('employee_number', $user->employee_number) }}" required>
                @error('employee_number')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-3">
              <label for="username" class="form-label">اسم المستخدم</label>
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username', $user->username) }}" required>
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
              <label for="role" class="form-label">الرتبة</label>
              <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>مستخدم</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مسؤول</option>
                <option value="committee_member" {{ $user->role == 'committee_member' ? 'selected' : '' }}>عضو لجنة</option>
              </select>
              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Department -->
            <div class="mb-3">
              <label for="department" class="form-label">القسم</label>
              <select name="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
                <option value="">اختر القسم</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
              </select>
              @error('department_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Program -->
            <div class="mb-3">
                <label for="department" class="form-label">البرنامج</label>
                <select name="program_id" class="form-control @error('program_id') is-invalid @enderror" required>
                    <option value="">اختر البرنامج</option>
                  @foreach ($programs as $program)
                      <option value="{{ $program->id }}" {{ $user->program_id == $program->id ? 'selected' : '' }}>
                          {{ $program->name }}
                      </option>
                  @endforeach
                </select>
                @error('program_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">كلمة المرور (تركه فارغًا إذا لم ترغب في تغييرها)</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="text-center">
              <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">تعديل بيانات {{ $user->full_name }}</button>
              <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary w-100 my-4 mb-2">إلغاء</a>
            </div>

          </form>
        </div>
      </div>
    </div>
</div>
@endsection
