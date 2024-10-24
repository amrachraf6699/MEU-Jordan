@extends('dashboard.layouts.app')
@section('title', 'إدارة البيانات')
@section('content')

<!-- Buttons Row -->
<div class="row mb-4">
    <div class="col-2">
        <button onclick="showModel('types')" class="btn btn-primary w-100">الأنواع</button>
    </div>
    <div class="col-2">
        <button onclick="showModel('statuses')" class="btn btn-primary w-100">الحالات</button>
    </div>
    <div class="col-2">
        <button onclick="showModel('languages')" class="btn btn-primary w-100">اللغات</button>
    </div>
    <div class="col-2">
        <button onclick="showModel('indexings')" class="btn btn-primary w-100">الفهرسة</button>
    </div>
    <div class="col-2">
        <button onclick="showModel('documentaion_periods')" class="btn btn-primary w-100">فترات التوثيق</button>
    </div>
    <div class="col-2">
        <button onclick="showModel('academic_years')" class="btn btn-primary w-100">السنوات الأكاديمية</button>
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
