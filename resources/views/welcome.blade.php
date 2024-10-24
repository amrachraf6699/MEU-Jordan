@extends('layouts.app')
@section('title', 'الرئيسية')
@section('content')
    <!-- Main Content -->
    <main class="flex-grow flex flex-row items-center justify-center p-6">
        <!-- Left Side: Smaller Image -->
        <div class="w-1/3">
            <img src="{{ asset('banner.jpg') }}" alt="Middle East University" class="w-full h-auto object-cover rounded-lg shadow-lg">
        </div>

        <!-- Right Side: Text and Button -->
        <div class="w-2/3 flex flex-col items-end justify-center text-right p-6">
            <!-- University and College Name -->
            <h1 class="text-5xl font-bold text-gray-800 mb-4">مَنَصَّة النَّتَاجَات البَحْثِيَّةِ</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">كليَّة الآداب والعلوم التربويَّة</h2>
            <p class="text-lg text-gray-600 mb-6">لجنة البحث العلمي</p>

            <!-- Login Button -->
            <a href="{{ route('login') }}" class="bg-yellow-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-yellow-700 transition duration-200">
                تسجيل الدخول
            </a>
        </div>
    </main>
@endsection
