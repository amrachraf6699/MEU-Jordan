@extends('layouts.app')
@section('title', 'نسيت كلمة السر')
@section('content')
<main class="flex-grow flex flex-col items-center justify-center text-center p-6">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">نسيت كلمة السر</h1>

    <p class="text-xs text-gray-600 mb-6">يرجى إدخال اسم المستخدم ومفتاح الاسترداد الخاص بك.</p>

    <form action="" method="POST" class="w-full max-w-md">
        @csrf

        <div class="mb-4">
            <label for="username" class="block text-left text-gray-700 mb-2">اسم المستخدم</label>
            <input type="text" id="username" name="username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('username') border-red-500 @enderror" placeholder="اسم المستخدم" value="{{ old('username') }}">
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="recover_key" class="block text-left text-gray-700 mb-2">مفتاح الاسترداد</label>
            <input type="text" id="recover_key" name="recover_key" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('recover_key') border-red-500 @enderror" placeholder="مفتاح الاسترداد" value="{{ old('recover_key') }}">
            @error('recover_key')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200 w-full">إعادة تعيين كلمة المرور</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">العودة إلى تسجيل الدخول</a>
    </div>
</main>
@endsection
