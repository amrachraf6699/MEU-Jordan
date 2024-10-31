@extends('dashboard.layouts.app')
@section('title', 'نشاطات المستخدم')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>نشاطات المستخدم</h6>
            </div>

            <div class="card-body px-4 pt-4 pb-2" style="max-height: 400px; overflow-y: auto;">
                <!-- User Activity List -->
                <div class="list-group">
                    @if($activities->isEmpty())
                        <p class="text-center text-muted">لا توجد نشاطات لعرضها</p>
                    @else
                        @foreach($activities as $activity)
                            <div class="list-group-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $activity->activity }}</h6>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($activity->created_at)->locale('ar')->translatedFormat('l Y-m-d H:i:s') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Pagination Links -->
            <div class="card-footer text-center">
                {{ $activities->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
