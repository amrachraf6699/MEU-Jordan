@extends('dashboard.layouts.app')
@section('title', 'إعتماد نموذج النتاجات البحثية')
@section('content')

<div class="row mb-4">
    <div class="col-md-4 mb-2">
        <button onclick="showModel('types')" class="btn btn-primary w-100">أنواع النتاجات البحثية</button>
    </div>
    <div class="col-md-4 mb-2">
        <button onclick="showModel('statuses')" class="btn btn-primary w-100">حالات النشر</button>
    </div>
    <div class="col-md-4 mb-2">
        <button onclick="showModel('languages')" class="btn btn-primary w-100">لغات النشر</button>
    </div>
    <div class="col-md-3 mb-2">
        <button onclick="showModel('indexings')" class="btn btn-primary w-100">الفهرسة</button>
    </div>
    <div class="col-md-3 mb-2">
        <button onclick="showModel('documentaion_periods')" class="btn btn-primary w-100">فترات التوثيق</button>
    </div>
    <div class="col-md-3 mb-2">
        <button onclick="showModel('academic_years')" class="btn btn-primary w-100">السنوات الأكاديمية</button>
    </div>
    <div class="col-md-3 mb-2">
        <button onclick="showModel('priorities')" class="btn btn-primary w-100">الأولويات البحثية</button>
    </div>
</div>



<!-- Tables and Forms -->
<div id="model-containers">

    <!-- Types -->
    <div id="types" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'الأنواع',
            'items' => $types,
            'column_name' => 'النوع',
            'delete_route' => 'dashboard.adopt.deleteType',
            'create_route' => 'dashboard.adopt.types'
        ])
    </div>

    <!-- Statuses -->
    <div id="statuses" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'الحالات',
            'items' => $statuses,
            'column_name' => 'الحالة',
            'delete_route' => 'dashboard.adopt.deleteStatus',
            'create_route' => 'dashboard.adopt.statuses'
        ])
    </div>

    <!-- Languages -->
    <div id="languages" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'اللغات',
            'items' => $languages,
            'column_name' => 'اللغة',
            'delete_route' => 'dashboard.adopt.deleteLanguage',
            'create_route' => 'dashboard.adopt.languages'
        ])
    </div>

    <!-- Indexings -->
    <div id="indexings" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'الفهرسة',
            'items' => $indexings,
            'column_name' => 'الفهرسة',
            'delete_route' => 'dashboard.adopt.deleteIndexing',
            'create_route' => 'dashboard.adopt.indexings'
        ])
    </div>

    <!-- Documentation Periods -->
    <div id="documentaion_periods" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'فترات التوثيق',
            'items' => $documentaion_periods,
            'column_name' => 'فترة التوثيق',
            'delete_route' => 'dashboard.adopt.deleteDocumentationPeriod',
            'create_route' => 'dashboard.adopt.documentaion_periods'
        ])
    </div>

    <!-- Academic Years -->
    <div id="academic_years" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'السنوات الأكاديمية',
            'items' => $academic_years,
            'column_name' => 'العام الأكاديمي',
            'delete_route' => 'dashboard.adopt.deleteAcademicYear',
            'create_route' => 'dashboard.adopt.academic_years'
        ])
    </div>

    <!-- Priorities -->
    <div id="priorities" class="model-section" style="display: none;">
        @include('dashboard.adopt-research.table-form', [
            'title' => 'الأولويات البحثية',
            'items' => $priorities,
            'column_name' => 'الأولوية البحثية',
            'delete_route' => 'dashboard.adopt.deletePriority',
            'create_route' => 'dashboard.adopt.priorities'
        ])
    </div>

    <hr>
    <h3 class="text-center mb-4">وصف الحقول</h3>
    <form action="" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="title">عنوان النتاج البحثي:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $hints->title ?? '' }}">
            </div>

            <div class="col-md-6 mb-2">
                <label for="type">نوع النتاج البحثي:</label>
                <input type="text" id="type" name="type" class="form-control" value="{{ $hints->type ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="status">حالة النشر:</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ $hints->status ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="language">لغة النشر:</label>
                <input type="text" id="language" name="language" class="form-control" value="{{ $hints->language ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="date_of_publication">تاريخ النشر:</label>
                <input type="text" id="date_of_publication" name="date_of_publication" class="form-control" value="{{ $hints->date_of_publication ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="sort">ترتيب المباحث:</label>
                <input type="text" id="sort" name="sort" class="form-control" value="{{ $hints->sort ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="sources">مصدر النتاج البحثي:</label>
                <input type="text" id="sources" name="sources" class="form-control" value="{{ $hints->sources ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="indexing">الفهرسة:</label>
                <input type="text" id="indexing" name="indexing" class="form-control" value="{{ $hints->indexing ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="evidences">تحميل الشواهد:</label>
                <input type="text" id="evidences" name="evidences" class="form-control" value="{{ $hints->evidences ?? '' }}" >
            </div>

            <div class="col-md-6 mb-2">
                <label for="documentaion_period">فترة التوثيق:</label>
                <input type="text" id="documentaion_period" name="documentaion_period" class="form-control" value="{{ $hints->documentaion_period ?? '' }}" >
            </div>

            <div class="col-md-6 mb-4">
                <label for="academic_year">العام الأكاديمي:</label>
                <input type="text" id="academic_year" name="academic_year" class="form-control" value="{{ $hints->academic_year ?? '' }}" >
            </div>

            <div class="col-md-6 mb-4">
                <label for="priority">الأولويات البحثية:</label>
                <input type="text" id="priority" name="priority" class="form-control" value="{{ $hints->priority ?? '' }}" >
            </div>

            <div class="col-md-6 mb-4">
                <label for="publication_link">رابط المنشور البحثي:</label>
                <input type="text" id="publication_link" name="publication_link" class="form-control" value="{{ $hints->publication_link ?? '' }}" >
            </div>

            <div class="col-md-12 mb-2">
                <button type="submit" class="btn btn-primary w-100">تحديث وصف الحقول</button>
            </div>
        </div>
    </form>



</div>

<script>
    function showModel(model) {
        var sections = document.querySelectorAll('.model-section');
        sections.forEach(function(section) {
            section.style.display = 'none';
        });

        var selectedSection = document.getElementById(model);
        selectedSection.style.display = 'block';
    }
</script>

@endsection
