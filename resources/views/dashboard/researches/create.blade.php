@extends('dashboard.layouts.app')
@section('title', 'إضافة نتاج بحثي جديد')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>إضافة نتاج بحثي جديد</h6>
            </div>

            <div class="card-body">
                <!-- Research Create Form -->
                <form action="{{ route('dashboard.researches.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">عنوان النتاج البحثي</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="أدخل عنوان النتاج البحثي" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Type (Dropdown) -->
                    <div class="form-group">
                        <label for="type">نوع النتاج البحثي</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">اختر نوع النتاج البحثي</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}" {{ old('type') == $type->value ? 'selected' : '' }}>{{ $type->value }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status (Dropdown) -->
                    <div class="form-group">
                        <label for="status">حالة النشر</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">اختر حالة النشر</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Language (Dropdown) -->
                    <div class="form-group">
                        <label for="language">لغة النشر</label>
                        <select name="language" id="language" class="form-control" required>
                            <option value="">اختر لغة النشر</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->value }}" {{ old('language') == $language->value ? 'selected' : '' }}>{{ $language->value }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <!-- Date of Publication -->
                     <div class="form-group">
                        <label for="date_of_publication">تاريخ النشر</label>
                        <input type="date" name="date_of_publication" id="date_of_publication" class="form-control" value="{{ old('date_of_publication') }}" required>
                        @error('date_of_publication')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Sort (Dropdown) -->
                    <div class="form-group">
                        <label for="sort">ترتيب المباحث</label>
                        <select name="sort" id="sort" class="form-control" required>
                            <option value="">اختر ترتيب المباحث</option>
                            <option value="منفرد" {{ old('sort') == 'منفرد' ? 'selected' : '' }}>منفرد</option>
                            <option value="باحث أول" {{ old('sort') == 'باحث أول' ? 'selected' : '' }}>باحث أول</option>
                            <option value="باحث ثاني" {{ old('sort') == 'باحث ثاني' ? 'selected' : '' }}>باحث ثاني</option>
                            <option value="باحث ثالث" {{ old('sort') == 'باحث ثالث' ? 'selected' : '' }}>باحث ثالث</option>
                            <option value="أكثر من ثالث" {{ old('sort') == 'أكثر من ثالث' ? 'selected' : '' }}>أكثر من ثالث</option>
                        </select>
                        @error('sort')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sources -->
                    <div class="form-group">
                        <label for="sources">مصدر النتاج البحثي</label>
                        <input type="text" name="sources" id="sources" class="form-control" value="{{ old('sources') }}" placeholder="أدخل مصدر النتاج البحثي" required>
                        @error('sources')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Indexing (Dropdown) -->
                    <div class="form-group">
                        <label for="indexing">الفهرسة</label>
                        <select name="indexing" id="indexing" class="form-control" required>
                            <option value="">اختر الفهرسة</option>
                            @foreach($indexings as $indexing)
                                <option value="{{ $indexing->value }}" {{ old('indexing') == $indexing->value ? 'selected' : '' }}>{{ $indexing->value }}</option>
                            @endforeach
                        </select>
                        @error('indexing')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Evidences (File Upload) -->
                    <div class="form-group">
                        <label for="evidences">تحميل الشواهد</label>
                        <input type="file" name="evidences" id="evidences" class="form-control" multiple>
                        @error('evidences')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Documentation Period (Dropdown) -->
                    <div class="form-group">
                        <label for="documentaion_period">فترة التوثيق</label>
                        <select name="documentaion_period" id="documentaion_period" class="form-control" required>
                            <option value="">اختر فترة التوثيق</option>
                            @foreach($documentaion_periods as $period)
                                <option value="{{ $period->value }}" {{ old('documentaion_period') == $period->value ? 'selected' : '' }}>{{ $period->value }}</option>
                            @endforeach
                        </select>
                        @error('documentaion_period_end')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Academic Year (Dropdown) -->
                    <div class="form-group">
                        <label for="academic_year">العام الأكاديمي</label>
                        <select name="academic_year" id="academic_year" class="form-control" required>
                            <option value="">اختر العام الأكاديمي</option>
                            @foreach($academic_years as $year)
                                <option value="{{ $year->value }}" {{ old('academic_year') == $year->value ? 'selected' : '' }}>{{ $year->value }}</option>
                            @endforeach
                        </select>
                        @error('academic_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">إضافة النتاج البحثي</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
