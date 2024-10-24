@extends('layouts.app')
@section('title', 'التسجيل')
@section('content')
<!-- Main Content -->
<main class="flex-grow flex flex-col items-center justify-center text-center p-6">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">إنشاء حساب جديد</h1>
    
    <p class="text-xs text-gray-600 mb-6">يرجى ملء التفاصيل الخاصة بك.</p>

    <form action="" method="POST" class="w-full max-w-md">
        @csrf
        
        <div class="mb-4">
            <label for="full_name" class="block text-left text-gray-700 mb-2">الاسم الثلاثي</label>
            <input type="text" id="full_name" name="full_name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('full_name') border-red-500 @enderror" placeholder="الاسم الثلاثي" value="{{ old('full_name') }}">
            @error('full_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="employee_number" class="block text-left text-gray-700 mb-2">الرقم الوظيفي</label>
            <input type="text" id="employee_number" name="employee_number" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('employee_number') border-red-500 @enderror" placeholder="الرقم الوظيفي" value="{{ old('employee_number') }}">
            @error('employee_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-left text-gray-700 mb-2">كلمة السر</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('password') border-red-500 @enderror" placeholder="كلمة السر">
            <p class="text-sm text-gray-500 mt-1">يرجى حفظ كلمة السر لتسجيل الدخول بها فيما بعد.</p>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="rank" class="block text-left text-gray-700 mb-2">الرتبة</label>
            <select id="rank" name="rank" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('rank') border-red-500 @enderror">
                <option value="" disabled selected>اختر الرتبة</option>
                <option value="مدير" {{ old('rank') == 'مدير' ? 'selected' : '' }}>مدير</option>
                <option value="نائب مدير" {{ old('rank') == 'نائب مدير' ? 'selected' : '' }}>نائب مدير</option>
                <option value="موظف" {{ old('rank') == 'موظف' ? 'selected' : '' }}>موظف</option>
            </select>
            @error('rank')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="department" class="block text-left text-gray-700 mb-2">القسم</label>
            <select id="department" name="department" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('department') border-red-500 @enderror">
                <option value="" disabled selected>اختر القسم</option>
                <option value="التقنية" {{ old('department') == 'التقنية' ? 'selected' : '' }}>التقنية</option>
                <option value="الإدارة" {{ old('department') == 'الإدارة' ? 'selected' : '' }}>الإدارة</option>
                <option value="البحث العلمي" {{ old('department') == 'البحث العلمي' ? 'selected' : '' }}>البحث العلمي</option>
            </select>
            @error('department')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="program" class="block text-left text-gray-700 mb-2">البرنامج</label>
            <select id="program" name="program" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('program') border-red-500 @enderror">
                <option value="" disabled selected>اختر البرنامج</option>
                <option value="برنامج 1" {{ old('program') == 'برنامج 1' ? 'selected' : '' }}>برنامج 1</option>
                <option value="برنامج 2" {{ old('program') == 'برنامج 2' ? 'selected' : '' }}>برنامج 2</option>
                <option value="برنامج 3" {{ old('program') == 'برنامج 3' ? 'selected' : '' }}>برنامج 3</option>
            </select>
            @error('program')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200 w-full">إنشاء حساب</button>
    </form>

    <p class="text-gray-600 mt-4">لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-blue-600 hover:underline">تسجيل الدخول</a></p>
</main>
@endsection
