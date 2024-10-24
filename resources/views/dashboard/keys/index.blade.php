@extends('dashboard.layouts.app')
@section('title', 'إعدادات رمز الاسترداد')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">إدارة رمز الاسترداد</h2>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    @if($key)
                        <h5 class="font-weight-bolder mb-0 text-success">
                            {{ $key->key }}
                        </h5>
                        <p class="text-warning mt-2">تأكد من حفظ هذا الرمز في مكان آمن، لن تتمكن من استرجاعه لاحقاً.</p>
                    @else
                        <h5 class="font-weight-bolder mb-0 text-danger">
                            لا يوجد رمز استرداد
                        </h5>
                    @endif
                </div>
            </div>
            <form action="" method="POST">
                @csrf

                @if($key)
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-key"></i> إنشاء رمز استرداد جديد
                    </button>
                </div>
                @else
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-key"></i> إنشاء رمز استرداد
                    </button>
                </div>
                @endif

            </form>
        </div>
    </div>
</div>
@endsection
