<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Researches Export</title>
    <style>
        body {
            font-family: 'XBRiyazRegular';
            font-weight: normal;
            font-style: normal;
            direction: rtl;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: right; /* Right align text */
            border: 1px solid #000;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        .english-text {
            font-family: Arial, sans-serif;
        }

        @page {
        header: page-header;
        footer: page-footer;
        }

    </style>
</head>
<body>
    <htmlpageheader name="page-header">
        <img src="{{ public_path('logo.png') }}" alt="Logo" width="200px">
    </htmlpageheader>

    <htmlpagefooter name="page-footer">
        <img src="{{ public_path('logo2.jpg') }}" alt="Logo" width="200px">
    </htmlpagefooter>



    <h2 style="margin-top: 50px">تفاصيل النتاجات البحثية</h2>
    <h5 style="margin-top: 10px">تم التصدير بواسطة: {{ auth()->user()->full_name }} في {{ now()->format('Y-m-d H:i:s') }}</h5>


    <table>
        <thead>
            <tr>
                <th>العنوان</th>
                <th>النوع</th>
                <th>حالة النشر</th>
                <th>حالة الإعتماد</th>
                <th>اللغة</th>
                <th>تاريخ النشر</th>
                <th>الترتيب</th>
                <th>الأدلة</th>
                <th>الفهرسة</th>
                <th>المصادر</th>
                <th>فترة التوثيق</th>
                <th>السنة الأكاديمية</th>
                <th>الأولويات البحثية</th>
                <th>رابط المنشور البحثي</th>
                <th>اسم المستخدم</th>
                <th>الرقم الوظيفي</th>
                <th>قسم المستخدم</th>
                <th>برنامج المستخدم</th>
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                    <th>تم فك الإعتماد بواسطة</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($researches as $research)
                <tr>
                    <td>{{ $research->title }}</td>
                    <td>{{ $research->type }}</td>
                    <td>{{ $research->status }}</td>
                    <td>{{ $research->accreditation_status }}</td>
                    <td>{{ $research->language }}</td>
                    <td>{{ $research->date_of_publication->format('Y/m/d') }}</td>
                    <td>{{ $research->sort }}</td>
                    <td class="english-text"><a href="{{ url($research->evidences) }}"> تحميــــل </a></td>
                    <td>{{ $research->indexing }}</td>
                    <td class="english-text">{{ $research->sources }}</td>
                    <td>{{ $research->documentaion_period }}</td>
                    <td>{{ $research->academic_year }}</td>
                    <td>{{ $research->priority }}</td>
                    <td>{{ $research->publication_link }}</td>
                    <td>{{ $research->user->full_name ?? 'مستخدم محذوف' }}</td>
                    <td>{{ $research->user->employee_number ?? '-' }}</td>
                    <td>{{ $research->user->department->name ?? '-' }}</td>
                    <td>{{ $research->user->program->name ?? '-' }}</td>
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'committee_member')
                        <td>{{ $research->revokedBy->full_name ?? 'لم يتم فك الإعتماد بعد' }}</td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
