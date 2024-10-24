@extends('layouts.app')
@section('title', 'تغيير كلمة المرور')

@section('content')
<main class="flex-grow flex flex-col items-center justify-center text-center p-6">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">تغيير كلمة المرور</h1>

    <form action="" method="POST" class="w-full max-w-md">
        @csrf
        <input type="hidden" name="user_id" value="">

        <div class="mb-4">
            <label for="password" class="block text-left text-gray-700 mb-2">كلمة المرور الجديدة</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('password') border-red-500 @enderror" placeholder="كلمة المرور الجديدة">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-left text-gray-700 mb-2">تأكيد كلمة المرور</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('password_confirmation') border-red-500 @enderror" placeholder="تأكيد كلمة المرور">
            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200 w-full">تغيير كلمة المرور</button>
    </form>
</main>
@endsection
