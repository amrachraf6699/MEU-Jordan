@extends('dashboard.layouts.app')
@section('title', 'إدارة المستخدمين')
@section('content')

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>جدول المستخدمين ({{ $users->total() }})</h6>

                <div class="d-flex align-items-center">
                    <!-- Button to Create New User -->
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary me-2">
                        إضافة مستخدم جديد
                    </a>

                    <!-- Dropdown for Export Options -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            تصدير
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.users.export', ['format' => 'excel']) }}">
                                    تصدير كـ Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.users.export', ['format' => 'pdf']) }}">
                                    تصدير كـ PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Form -->
            <div class="card-header pb-0">
                <form action="{{ route('dashboard.users.index') }}" method="GET" class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="البحث بالاسم أو اسم المستخدم" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="department_id" class="form-control">
                            <option value="">اختر القسم</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="program_id" class="form-control">
                            <option value="">اختر البرنامج</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">بحث</button>
                    </div>
                </form>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإسم</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الرتبة</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الإنضمام</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القسم</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البرنامج</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عدد الأبحاث</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $user->full_name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $user->username }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if ($user->role === 'user')
                                        <span class="text-secondary text-xs font-weight-bold">مستخدم</span>
                                    @elseif ($user->role === 'admin')
                                        <span class="text-secondary text-xs font-weight-bold">مسؤول نظام</span>
                                    @elseif ($user->role === 'committee_member')
                                        <span class="text-secondary text-xs font-weight-bold">عضو لجنة</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-danger">لم يتم الإختيار بعد</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('Y/m/d h:i') }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($user->department)
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->department->name}}</span>
                                    @else
                                    <span class="badge badge-sm bg-gradient-danger">لم يتم الإختيار بعد</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($user->program)
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->program->name }}</span>
                                    @else
                                    <span class="badge badge-sm bg-gradient-danger">لم يتم الإختيار بعد</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-{{ $user->researches_count > 0 ? 'success' : 'danger' }}">{{ $user->researches_count }}</span>
                                </td>
                                <td class="align-middle">
                                    <!-- Edit Link -->
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}?page={{ request('page') }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        تعديل
                                    </a>

                                    <!-- Separator -->
                                    |

                                    <!-- Delete Form -->
                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:;" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user" onclick="confirmDelete({{ $user->id }})">
                                            حذف
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                لا يوجد مستخدمين
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function confirmDelete(userId) {
        if (confirm('هل تريد بالتأكيد حذف هذا المستخدم؟')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
</script>

@endsection
