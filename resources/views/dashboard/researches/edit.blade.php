@extends('dashboard.layouts.app')
@section('title', 'تعديل البحث')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>تعديل البحث: {{ $research->title }}</h6>
            </div>

            <div class="card-body">
                <!-- Research Edit Form -->
                <form action="{{ route('dashboard.researches.update', $research->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">عنوان البحث</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $research->title) }}" placeholder="أدخل عنوان البحث" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="form-group">
                        <label for="type">نوع البحث</label>
                        <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $research->type) }}" placeholder="أدخل نوع البحث" required>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Language -->
                    <div class="form-group">
                        <label for="language">اللغة</label>
                        <input type="text" name="language" id="language" class="form-control" value="{{ old('language', $research->language) }}" placeholder="أدخل اللغة" required>
                        @error('language')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date of Publication -->
                    <div class="form-group">
                        <label for="date_of_publication">تاريخ النشر</label>
                        <input type="date" name="date_of_publication" id="date_of_publication" class="form-control" value="{{ old('date_of_publication', optional($research->date_of_publication)->format('Y-m-d')) }}" required>
                        @error('date_of_publication')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sort -->
                    <div class="form-group">
                        <label for="sort">ترتيب المباحث</label>
                        <input type="text" name="sort" id="sort" class="form-control" value="{{ old('sort', $research->sort) }}" placeholder="أدخل ترتيب المباحث" required>
                        @error('sort')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Evidences (File Upload) -->
                    <div class="form-group">
                        <label for="evidences">الشواهد</label>
                        <input type="file" name="evidences" id="evidences" class="form-control">
                        <small>يمكنك تحميل ملفات جديدة إذا رغبت.</small>
                        @error('evidences')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Indexing -->
                    <div class="form-group">
                        <label for="indexing">الفهرسة</label>
                        <input type="text" name="indexing" id="indexing" class="form-control" value="{{ old('indexing', $research->indexing) }}" placeholder="أدخل الفهرسة" required>
                        @error('indexing')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sources -->
                    <div class="form-group">
                        <label for="sources">المصادر</label>
                        <input type="text" name="sources" id="sources" class="form-control" value="{{ old('sources', $research->sources) }}" placeholder="أدخل المصادر" required>
                        @error('sources')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Documentation Period Start -->
                    <div class="form-group">
                        <label for="documentaion_period_start">بداية فترة التوثيق</label>
                        <input type="date" name="documentaion_period_start" id="documentaion_period_start" class="form-control" value="{{ old('documentaion_period_start', optional($research->documentaion_period_start)->format('Y-m-d')) }}" required>
                        @error('documentaion_period_start')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Documentation Period End -->
                    <div class="form-group">
                        <label for="documentaion_period_end">نهاية فترة التوثيق</label>
                        <input type="date" name="documentaion_period_end" id="documentaion_period_end" class="form-control" value="{{ old('documentaion_period_end', optional($research->documentaion_period_end)->format('Y-m-d')) }}" required>
                        @error('documentaion_period_end')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Academic Year -->
                    <div class="form-group">
                        <label for="academic_year">السنة الأكاديمية</label>
                        <input type="text" name="academic_year" id="academic_year" class="form-control" value="{{ old('academic_year', $research->academic_year) }}" placeholder="أدخل السنة الأكاديمية" required>
                        @error('academic_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">تحديث البحث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
