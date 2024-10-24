<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Researches Export</title>
    <style>
        body {
            font-family: 'KFGQPC Uthman Taha Naskh', Arial, sans-serif; /* Add fallback fonts */
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
        <img src="{{ public_path('logo.svg') }}" alt="Logo">
    </htmlpageheader>

    <htmlpagefooter name="page-footer">
        <img src="{{ public_path('logo2.jpg') }}" alt="Logo">
    </htmlpagefooter>


    <h2>تفاصيل النتاجات البحثية</h2>

    <table>
        <thead>
            <tr>
                <th>العنوان</th>
                <th>النوع</th>
                <th>الحالة</th>
                <th>اللغة</th>
                <th>تاريخ النشر</th>
                <th>الترتيب</th>
                <th>الأدلة</th>
                <th>الفهرسة</th>
                <th>المصادر</th>
                <th>فترة التوثيق</th>
                <th>السنة الأكاديمية</th>
                <th>اسم المستخدم</th>
                <th>رقم الموظف</th>
                <th>اسم القسم</th>
                <th>اسم البرنامج</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researches as $research)
                <tr>
                    <td>{{ $research->title }}</td>
                    <td>{{ $research->type }}</td>
                    <td>{{ $research->status }}</td>
                    <td>{{ $research->language }}</td>
                    <td>{{ $research->date_of_publication->format('Y/m/d') }}</td>
                    <td>{{ $research->sort }}</td>
                    <td class="english-text">{{ url($research->evidences) }}</td>
                    <td>{{ $research->indexing }}</td>
                    <td class="english-text">{{ $research->sources }}</td>
                    <td>{{ $research->documentaion_period }}</td>
                    <td>{{ $research->academic_year }}</td>
                    <td>{{ $research->user->full_name }}</td>
                    <td>{{ $research->user->employee_number }}</td>
                    <td>{{ $research->user->department->name ?? 'N/A' }}</td>
                    <td>{{ $research->user->program->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
