@extends('dashboard.layouts.app')
@section('title', 'تعديل النتاج البحثي')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>تعديل النتاج البحثي: {{ $research->title }}</h6>
            </div>

            <div class="card-body">
                <!-- Research Edit Form -->
                <form action="{{ route('dashboard.researches.update', $research->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">عنوان النتاج البحثي</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $research->title) }}" placeholder="أدخل عنوان النتاج البحثي" required>
                        <small class="form-text text-muted">{{ $hints->title ?? '' }}</small>
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
                                <option value="{{ $type->value }}" {{ $research->type == $type->value ? 'selected' : '' }}>{{ $type->value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->type ?? '' }}</small>
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
                                <option value="{{ $status->value }}" {{ old('status', $research->status) == $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->status ?? '' }}</small>
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
                                <option value="{{ $language->value }}" {{ old('language', $research->language) == $language->value ? 'selected' : '' }}>{{ $language->value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->language ?? '' }}</small>
                        @error('language')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date of Publication -->
                    <div class="form-group">
                        <label for="date_of_publication">تاريخ النشر</label>
                        <input type="date" name="date_of_publication" id="date_of_publication" class="form-control" value="{{ old('date_of_publication', optional($research->date_of_publication)->format('Y-m-d')) }}" required>
                        <small class="form-text text-muted">{{ $hints->date_of_publication ?? '' }}</small>
                        @error('date_of_publication')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sort (Dropdown) -->
                    <div class="form-group">
                        <label for="sort">ترتيب المباحث</label>
                        <select name="sort" id="sort" class="form-control" required>
                            <option value="">اختر ترتيب المباحث</option>
                            @foreach(['منفرد', 'باحث أول', 'باحث ثاني', 'باحث ثالث', 'أكثر من ثالث'] as $sortOption)
                                <option value="{{ $sortOption }}" {{ $research->sort == $sortOption ? 'selected' : '' }}>{{ $sortOption }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->sort ?? '' }}</small>
                        @error('sort')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Sources -->
                    <div class="form-group">
                        <label for="sources">المصادر</label>
                        <input type="text" name="sources" id="sources" class="form-control" value="{{ old('sources', $research->sources) }}" placeholder="أدخل المصادر" required>
                        <small class="form-text text-muted">{{ $hints->sources ?? '' }}</small>
                        @error('sources')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                   <!-- Indexing (Dropdown) -->
                    <div class="form-group">
                        <label for="indexing">الفهرسة</label>
                        <select name="indexing[]" id="indexing" class="form-control" required multiple>
                            @php
                                // Convert the comma-separated string to an array
                                $selectedIndexing = old('indexing', explode(',', $research->indexing ?? ''));
                            @endphp
                            @foreach($indexings as $index)
                                <option value="{{ $index->value }}"
                                    {{ in_array($index->value, $selectedIndexing) ? 'selected' : '' }}>
                                    {{ $index->value }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->indexing ?? '' }}</small>
                        @error('indexing')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Evidences (File Upload) -->
                    <div class="form-group">
                        <label for="evidences">تحميل الشواهد</label>
                        <input type="file" name="evidences" id="evidences" class="form-control">
                        <small>يمكنك تحميل ملفات جديدة إذا رغبت.</small>
                        <small class="form-text text-muted">{{ $hints->evidences ?? '' }}</small>
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
                                <option value="{{ $period->value }}" {{ old('documentaion_period', $research->documentaion_period) == $period->value ? 'selected' : '' }}>
                                    {{ $period->value }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->documentaion_period ?? '' }}</small>
                        @error('documentaion_period')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Academic Year (Dropdown) -->
                    <div class="form-group">
                        <label for="academic_year">السنة الأكاديمية</label>
                        <select name="academic_year" id="academic_year" class="form-control" required>
                            <option value="">اختر السنة الأكاديمية</option>
                            @foreach($academic_years as $year)
                                <option value="{{ $year->value }}" {{ old('academic_year', $research->academic_year) == $year->value ? 'selected' : '' }}>{{ $year->value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->academic_year ?? '' }}</small>
                        @error('academic_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Proirities (Dropdown) -->
                    <div class="form-group">
                        <label for="priority">الأولويات البحثية</label>
                        <select name="priority" id="priority" class="form-control" required>
                            <option value="">اختر الأولوية البحثية</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->value }}" {{ old('priority', $research->priority) == $priority->value ? 'selected' : '' }}>{{ $priority->value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ $hints->priorities }}</small>
                        @error('priorities')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Puplication Link -->
                    <div class="form-group">
                        <label for="publication_link">رابط المنشور البحثي</label>
                        <input type="text" name="publication_link" id="publication_link" class="form-control" value="{{ old('publication_link', $research->publication_link) }}" placeholder="أدخل رابط المنشور البحثي">
                        <small class="form-text text-muted">{{ $hints->publication_link }}</small>
                        @error('publication_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-3">تحديث النتاج البحثي</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
