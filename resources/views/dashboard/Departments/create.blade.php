@extends('dashboard.layouts.app')
@section('title', 'إنشاء قسم جديد')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h6 class="mb-0">إنشاء قسم جديد</h6>
                <a href="{{ route('dashboard.departments.index') }}" class="btn btn-secondary btn-sm">عودة إلى الأقسام</a>
            </div>

            <div class="card-body px-4 pt-3 pb-4">
                <!-- Create Program Form -->
                <form action="{{ route('dashboard.departments.store') }}" method="POST">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم القسم <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="أدخل اسم القسم">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">إضافة القسم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
