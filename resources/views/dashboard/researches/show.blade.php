@extends('dashboard.layouts.app')
@section('title', 'تفاصيل البحث')

@section('content')

<div class="container mx-auto mt-4">
    <div class="card mb-4 shadow-lg rounded-lg">
        <div class="card-header bg-blue-600 text-white rounded-t-lg">
            <h6 class="text-lg font-semibold">تفاصيل البحث: {{ $research->title }}</h6>
        </div>
        <div class="card-body p-6">

            <!-- Main Research Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h5 class="font-bold text-lg mb-2">معلومات البحث الأساسية</h5>
                    <p><strong>عنوان البحث:</strong> {{ $research->title }}</p>
                    <p><strong>نوع البحث:</strong> {{ $research->type }}</p>
                    <p><strong>اللغة:</strong> {{ $research->language }}</p>
                    <p><strong>ترتيب المباحث:</strong> {{ $research->sort }}</p>
                    <p><strong>الفهرسة:</strong> {{ $research->indexing }}</p>
                    <p><strong>المصادر:</strong> {{ $research->sources }}</p>
                    <p><strong>السنة الأكاديمية:</strong> {{ $research->academic_year }}</p>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h5 class="font-bold text-lg mb-2">تواريخ مهمة</h5>
                    <p><strong>تاريخ النشر:</strong> {{ $research->date_of_publication->format('Y-m-d') }}</p>
                    <p><strong>بداية فترة التوثيق:</strong> {{ $research->documentaion_period_start->format('Y-m-d') }}</p>
                    <p><strong>نهاية فترة التوثيق:</strong> {{ $research->documentaion_period_end->format('Y-m-d') }}</p>
                </div>
            </div>

            <!-- User Information -->
            <div class="bg-gray-100 p-4 rounded-lg shadow mb-8">
                <h5 class="font-bold text-lg mb-2">تم التقديم بواسطة</h5>
                <p><strong>الاسم:</strong> {{ $research->user->full_name }}</p>
                <p><strong> اسم المستخدم:</strong> {{ $research->user->username }}</p>
            </div>

            <!-- Evidences Section -->
            <div class="bg-gray-100 p-4 rounded-lg shadow mb-8">
                <h5 class="font-bold text-lg mb-2">الشواهد</h5>
                @if ($research->evidences)
                    <a href="{{ asset('storage/' . $research->evidences) }}" class="text-blue-600 hover:underline">
                        تحميل الشواهد
                    </a>
                @else
                    <p class="text-red-500">لا توجد شواهد متاحة.</p>
                @endif
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('dashboard.researches.index') }}" class="btn btn-primary">
                    العودة إلى قائمة الأبحاث
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
