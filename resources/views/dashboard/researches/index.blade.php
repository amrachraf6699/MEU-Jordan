@extends('dashboard.layouts.app')
@section('title', 'إدارة النتاجات البحثية')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>جدول النتاجات البحثية ({{ $researches->total() }})</h6>

                <!-- Button to Create New Research -->
                <a href="{{ route('dashboard.researches.create') }}" class="btn btn-primary">
                    إضافة نتاج بحثي جديد
                </a>
            </div>

            <!-- Search and Filter Form -->
            <div class="card-header pb-0">
                <form action="{{ route('dashboard.researches.index') }}" method="GET" class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="البحث بالعنوان" value="{{ request('search') }}">
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
                        <select name="status" class="form-control">
                            <option value="">اختر الحالة</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>معلق</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>مُعتمد</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض/محذوف</option>
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
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->user->full_name }}</span>
                                </td>
                                @endif
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $research->type }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    @if ($research->status === 'pending')
                                        <span class="text-warning text-xs font-weight-bold">معلق</span>
                                    @elseif ($research->status === 'approved')
                                        <span class="text-success text-xs font-weight-bold">مٌعتمد</span>
                                    @elseif ($research->status === 'rejected')
                                        <span class="text-danger text-xs font-weight-bold">مرفوض/محذوف</span>
                                    @endif
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
                                <td class="align-middle">
                                        @if($research->status === 'pending')
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

                                            <!-- Show Link -->
                                            <a href="{{ route('dashboard.researches.show', $research) }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                عرض
                                            </a>

                                            <!-- Separator -->
                                            |

                                            <a href="{{ route('dashboard.researches.export', ['research' => $research->id, 'type' => 'excel']) }}" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Export to Excel">
                                                Excel
                                            </a>

                                            |
                                            <!-- Export to PDF Link with Icon -->
                                            <a href="{{ route('dashboard.researches.export', ['research' => $research->id, 'type' => 'pdf']) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Export to Excel">
                                                PDF
                                            </a>
                                        @else
                                            @if(auth()->user()->role == 'admin')
                                            <a href="{{ route('dashboard.researches.revoke', $research) }}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                فك الإعتماد
                                            </a>
                                            |
                                            @endif
                                            <!-- Show Link -->
                                            <a href="{{ route('dashboard.researches.show', $research) }}" class="text-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                عرض
                                            </a>

                                            <!-- Separator -->
                                            |

                                            <!-- Export to Excel Link with Icon -->
                                            <a href="{{ route('dashboard.researches.export', ['research' => $research->id, 'type' => 'excel']) }}" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Export to Excel">
                                                Excel
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
