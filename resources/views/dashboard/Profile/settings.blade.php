@extends('dashboard.layouts.app')
@section('title', 'إعدادات الملف الشخصي')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>إعدادات الملف الشخصي</h6>
            </div>

            <div class="card-body px-4 pt-4 pb-2">
                <!-- Update Password Form -->
                <form action="" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="old_password" class="form-label">كلمة المرور القديمة</label>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="أدخل كلمة المرور القديمة" required>
                        @error('old_password')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور الجديدة</label>
                        <input type="text" name="password" class="form-control" placeholder="أدخل كلمة المرور الجديدة" required value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="أكد كلمة المرور الجديدة" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">تحديث كلمة المرور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
