@extends('layouts.app')
@section('title', 'تسجيل الدخول')
@section('content')
<!-- Main Content -->
<main class="flex-grow flex flex-col items-center justify-center text-center p-6">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">تسجيل الدخول</h1>

    <p class="text-xs text-gray-600 mb-6">يرجى إدخال تفاصيل حسابك.</p>

    <form action="{{ route('login') }}" method="POST" class="w-full max-w-md">
        @csrf

        <div class="mb-4">
            <label for="username" class="block text-left text-gray-700 mb-2">اسم المستخدم</label>
            <input type="text" id="username" name="username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('username') border-red-500 @enderror" placeholder="اسم المستخدم" value="{{ old('username') }}">
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-left text-gray-700 mb-2">كلمة السر</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('password') border-red-500 @enderror" placeholder="كلمة السر">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200 w-full">تسجيل الدخول</button>

        <!-- Forgot Password Link -->
        <div class="mt-4">
            <a href="{{ route('forgot') }}" class="text-blue-600 hover:underline">نسيت كلمة السر؟</a>
        </div>
    </form>
</main>
@endsection
