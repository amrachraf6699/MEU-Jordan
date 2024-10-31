@extends('dashboard.layouts.app')
@section('title', 'إدارة النتاجات البحثية')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>جدول النتاجات البحثية ({{ $researches->total() }})</h6>

                <div class="d-flex align-items-center">
                    <!-- Button to Create New User -->
                    <a href="{{ route('dashboard.researches.create') }}" class="btn btn-primary me-2">
                        إضافة نتاج بحثي جديد
                    </a>

                    <!-- Dropdown for Export Options -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            تصدير
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.researches.exportall', ['format' => 'excel']) }}">
                                    تصدير كـ Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.researches.exportall', ['format' => 'pdf']) }}">
                                    تصدير كـ PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Form -->
            <div class="card" style="max-width: 100%; margin: auto;">
                <div class="card-body p-2">
                    <form action="{{ route('dashboard.researches.index') }}" method="GET" class="row g-2 align-items-center">

                        <!-- Search Input -->
                        <div class="col-auto">
                            <label for="search" class="form-label small mb-0">البحث بالعنوان</label>
                            <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="أدخل عنوان البحث" value="{{ request('search') }}">
                        </div>

                        @if(auth()->user()->role == 'admin')
                        <!-- Department Dropdown -->
                        <div class="col-auto">
                            <label for="department_id" class="form-label small mb-0">اختر القسم</label>
                            <select name="department_id" id="department_id" class="form-select form-select-sm">
                                <option value="">اختر القسم</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                        <!-- Department Dropdown -->
                        <div class="col-auto">
                            <label for="program_id" class="form-label small mb-0">اختر البرنامج</label>
                            <select name="program_id" id="program_id" class="form-select form-select-sm">
                                <option value="">اختر البرنامج</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Status Dropdown -->
                        <div class="col-auto">
                            <label for="status" class="form-label small mb-0">اختر حالة النشر</label>
                            <select name="status" id="status" class="form-select form-select-sm">
                                <option value="">اختر حالة النشر</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                                        {{ $status->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Accreditation Status Dropdown -->
                        <div class="col-auto">
                            <label for="accreditation_status" class="form-label small mb-0">اختر حالة الإعتماد</label>
                            <select name="accreditation_status" id="accreditation_status" class="form-select form-select-sm">
                                <option value="">اختر حالة الإعتماد</option>
                                <option value="معلق" {{ request('accreditation_status') == 'معلق' ? 'selected' : '' }}>معلق</option>
                                <option value="معتمد" {{ request('accreditation_status') == 'معتمد' ? 'selected' : '' }}>معتمد</option>
                            </select>
                        </div>

                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                        <!-- My Researches Checkbox -->
                        <div class="col-auto">
                            <div class="form-check form-check-inline mt-4">
                                <input type="checkbox" name="my_researches" id="my_researches" class="form-check-input" {{ request('my_researches') ? 'checked' : '' }}>
                                <label for="my_researches" class="form-check-label small">نتاجاتي البحثية</label>
                            </div>
                        </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="col-auto mt-5">
                            <button type="submit" class="btn btn-primary btn-sm">بحث</button>
                        </div>

                    </form>
                </div>
            </div>


            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العنوان</th>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">المستخدم</th>
                                @endif
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النوع</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اللغة</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المصدر</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الفهرسة</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ النشر</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($researches as $research)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $research->title }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $research->academic_year }}</p>
                                        </div>
                                    </div>
                                </td>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                                <td class="align-middle text-center">
                                    @if($research->user)
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->user->full_name}}</span>
                                    @else
                                    <span class="text-danger text-xs font-weight-bold">مستخدم محذوف</span>
                                    @endif
                                </td>
                                @endif
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->type }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-primary text-xs font-weight-bold">{{ $research->status }}/{{ $research->accreditation_status }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->language }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->sources }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->indexing }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->date_of_publication->format('Y-m-d') }}</span>
                                </td>
                                <td class="align-middle">
                                        @if($research->accreditation_status !== 'معتمد')
                                            @if(auth()->id() == $research->user_id || auth()->user()->role == 'admin')

                                                <!-- Edit Link -->
                                                <a href="{{ route('dashboard.researches.edit', $research) }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    تعديل
                                                </a>

                                                <!-- Separator -->
                                                |

                                                <!-- Delete Form -->
                                                <form action="{{ route('dashboard.researches.destroy', $research->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $research->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:;" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user" onclick="confirmDelete({{ $research->id }})">
                                                        حذف
                                                    </a>
                                                </form>

                                                <!-- Separator -->
                                                |

                                                <!-- Approve Link -->
                                                <a href="{{ route('dashboard.researches.approve', $research) }}" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Approve user">
                                                    إعتماد
                                                </a>


                                            <!-- Separator -->
                                            |

                                            @endif


                                            <!-- Show Link -->
                                            <a href="{{ route('dashboard.researches.show', $research) }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                عرض
                                            </a>

                                            |
                                            <!-- Export to PDF Link with Icon -->
                                            <a href="{{ route('dashboard.researches.export', ['research' => $research->id, 'type' => 'pdf']) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Export to Excel">
                                                PDF
                                            </a>
                                        @else
                                            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                                            <a href="{{ route('dashboard.researches.revoke', $research) }}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                فك الإعتماد
                                            </a>
                                            |
                                            @endif
                                            <!-- Show Link -->
                                            <a href="{{ route('dashboard.researches.show', $research) }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                عرض
                                            </a>


                                            |
                                            <!-- Export to PDF Link with Icon -->
                                            <a href="{{ route('dashboard.researches.export', ['research' => $research->id, 'type' => 'pdf']) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Export to Excel">
                                                PDF
                                            </a>
                                        @endif

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                لا توجد أبحاث
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $researches->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(researchId) {
        if (confirm('هل تريد بالتأكيد حذف هذا البحث؟')) {
            document.getElementById('delete-form-' + researchId).submit();
        }
    }
</script>

@endsection
