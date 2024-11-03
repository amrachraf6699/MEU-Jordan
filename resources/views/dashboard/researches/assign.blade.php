@extends('dashboard.layouts.app')
@section('title', 'إسناد النتاج البحثي')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>إسناد النتاج البحثي: {{ $research->title }}</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('dashboard.researches.assignStore', $research->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Users (Dropdown) -->
                    <div class="form-group">
                        <label for="user_id">إسناد النتاج البحثي لمستخدم</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">اختر المستخدم</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-3">إسناد النتاج البحثي</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
