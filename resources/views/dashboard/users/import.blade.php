@extends('dashboard.layouts.app')
@section('title', 'استيراد المستخدمين')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>استيراد المستخدمين من ملف Excel</h6>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <!-- Import Users Form -->
                <form action="{{ route('dashboard.users.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row p-4">
                        <!-- Excel File Input -->
                        <div class="col-md-12 mb-3">
                            <label for="file" class="form-label">اختر ملف Excel</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                            @error('file')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary w-100">استيراد المستخدمين</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
