@extends('dashboard.layouts.app')
@section('title', 'إدارة الأقسام')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>جدول الأقسام ({{ $departments->total() }})</h6>

                <!-- Button to Create New Program -->
                <a href="{{ route('dashboard.departments.create') }}" class="btn btn-primary">
                    إضافة قسم جديد
                </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم البرنامج</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الإنشاء</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عدد المستخدمين</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departments as $program)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $program->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $program->created_at->format('Y/m/d h:i') }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-sm bg-gradient-{{ $program->users_count > 0 ? 'success' : 'danger' }}">{{ $program->users_count }}</span>
                                </td>
                                <td class="align-middle">
                                    <!-- Edit Link -->
                                    <a href="{{ route('dashboard.departments.edit', $program) }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit program">
                                        تعديل
                                    </a>

                                    <!-- Separator -->
                                    |

                                    <!-- Delete Form -->
                                    <form action="{{ route('dashboard.departments.destroy', $program->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $program->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:;" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete program" onclick="confirmDelete({{ $program->id }})">
                                            حذف
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    لا يوجد برامج
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $departments->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(programId) {
        if (confirm('هل تريد بالتأكيد حذف هذا البرنامج؟')) {
            document.getElementById('delete-form-' + programId).submit();
        }
    }
</script>

@endsection
