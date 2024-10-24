@extends('dashboard.layouts.app')
@section('title', 'الصفحة الرئيسية')
@section('content')
<div class="row">
    @if(auth()->user()->role == 'admin')
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <a href="{{ route('dashboard.users.index') }}">
            <div class="card">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد المستخدمين</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ $users_count }}
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-start">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="bx bxs-user text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </a>
      </div>
      <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد الأقسام</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $departments_count }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-start">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="bx bx-category text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد البرامج</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $programs_count }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-start">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="bx bx-notepad text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد النتاجات البحثية</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $researches_count }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-start">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="bx bx-file-blank text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    @else
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <a href="#">
            <div class="card">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">نتاجاتي البحثية</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ $my_reserches_count }}
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-start">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="bx bx-file-blank text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </a>
      </div>
        @if(auth()->user()->role == 'committee_member')

        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <a href="#">
                <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">نتاجات قسمي البحثية</p>
                        <h5 class="font-weight-bolder mb-0">
                            {{ $my_department_researches_count }}
                        </h5>
                        </div>
                    </div>
                    <div class="col-4 text-start">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="bx bx-file-blank text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </a>
        </div>
        @endif
      @endif


  <div class="col-12 mt-4">
    @if ($isProfileComplete)
            <div class="alert alert-success">
                <strong>الملف الشخصي مكتمل!</strong> يمكنك البدء في استخدام النظام.
            </div>
    @else
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>أكمل البيانات لتتمكن من رفع الأبحاث</h6>
        </div>
        <div class="card-body px-4 pt-4 pb-2">
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="employee_number" class="form-label">الرقم الوظيفي</label>
                    <input type="text" name="employee_number" class="form-control" value="{{ $user->employee_number }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">الرتبة</label>
                    <input type="text" name="role" class="form-control" value="@if($user->role == 'user') مستخدم
                    @elseif($user->role == 'admin') مدير نظام
                    @elseif($user->role == 'committee_member') عضو لجنة
                    @endif
                    " readonly>
                </div>
                <div class="mb-3">
                    <label for="department_id" class="form-label">القسم</label>
                    <select name="department_id" class="form-control" {{ $user->department_id ? 'readonly' : '' }} >
                        <option value="">اختر القسم</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ (old('department_id') == $department->id || $user->department_id == $department->id) ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-danger text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="program_id" class="form-label">البرنامج</label>
                    <select name="program_id" class="form-control" {{ $user->program_id ? 'readonly' : '' }} >
                        <option value="">اختر البرنامج</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ (old('program_id') == $program->id || $user->program_id == $program->id) ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('program_id')
                        <div class="text-danger text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" {{ $user->full_name && $user->employee_number && $user->role && $user->department_id && $user->program_id && $user->username ? 'disabled' : '' }}>
                        تحديث المعلومات
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
</div>
@endsection
