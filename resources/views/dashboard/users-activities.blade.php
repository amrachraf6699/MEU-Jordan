@extends('dashboard.layouts.app')

@section('title', 'نشاطات المستخدم')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>نشاطات المستخدم</h6>
            </div>

            <div class="card-header pb-0">
                <form action="" method="GET" class="row">
                    <div class="col-md-3">
                        <label for="user_id">المستخدم:</label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="">جميع المستخدمين</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                @if(request()->get('user_id') == $user->id) selected @endif>
                                    {{ $user->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="from_date">من تاريخ:</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request()->get('from_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="to_date">إلى تاريخ:</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request()->get('to_date') }}">
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" class="btn btn-primary w-100">بحث</button>
                    </div>
                </form>
            </div>
            <div class="card-body px-4 pt-4 pb-2">
                <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                    @if($activities->isEmpty())
                        <p class="text-center text-muted">لا توجد نشاطات لعرضها</p>
                    @else
                    @foreach($activities as $activity)
                        <div class="list-group-item mb-3 activity-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="activity-details">
                                    <small class="mb-1">{{ $activity->activity }}</small>
                                    <small class="text-muted">
                                        ({{ \Carbon\Carbon::parse($activity->created_at)->locale('ar')->translatedFormat('l Y-m-d H:i:s') }})
                                    </small>
                                </div>
                                <div class="activity-user">
                                    <small class="mb-1">{{ $activity->user->full_name }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="card-footer text-center">
                {{ $activities->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
