<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل البحث</title>
    <style>
        body {
            font-family: 'KFGQPC Uthman Taha Naskh', Arial, sans-serif; /* Add fallback fonts */
            direction: rtl;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right; /* Align text to the right for Arabic */
        }

        th {
            background-color: #f2f2f2;
        }

        .english-text {
            font-family: Arial, sans-serif; /* Fallback for English text */
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

    <h2>تفاصيل البحث</h2>

    <table>
        <tr>
            <th>العنوان</th>
            <td>{{ $research->title }}</td>
        </tr>
        <tr>
            <th>النوع</th>
            <td>{{ $research->type }}</td>
        </tr>
        <tr>
            <th>الحالة</th>
            <td>
                @if($research->status === 'pending')
                    معلق
                @elseif($research->status === 'approved')
                    مُعتمد
                @elseif($research->status === 'rejected')
                    محذوف/مرفوض
                @else
                    <span class="english-text">{{ $research->status }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>اللغة</th>
            <td class="english-text">{{ $research->language }}</td>
        </tr>
        <tr>
            <th>تاريخ النشر</th>
            <td class="english-text">{{ $research->date_of_publication->format('Y-m-d') }}</td>
        </tr>
        <tr>
            <th>الترتيب</th>
            <td class="english-text">{{ $research->sort }}</td>
        </tr>
        <tr>
            <th>الأدلة</th>
            <td class="english-text"><a href="{{ url($research->evidences) }}"> تحميــــل </a></td>
        </tr>
        <tr>
            <th>الفهرسة</th>
            <td class="english-text">{{ $research->indexing }}</td>
        </tr>
        <tr>
            <th>المصادر</th>
            <td class="english-text">{{ $research->sources }}</td>
        </tr>
        <tr>
            <th>فترة التوثيق</th>
            <td class="english-text">{{ $research->documentaion_period }}</td>
        </tr>
        <tr>
            <th>السنة الأكاديمية</th>
            <td class="english-text">{{ $research->academic_year }}</td>
        </tr>
        <tr>
            <th>الاسم الكامل للمستخدم</th>
            <td class="english-text">{{ $research->user->full_name }}</td>
        </tr>
        <tr>
            <th>اسم المستخدم</th>
            <td class="english-text">{{ $research->user->username }}</td>
        </tr>
        <tr>
            <th>تاريخ الإنشاء</th>
            <td class="english-text">{{ $research->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <th>تاريخ التحديث</th>
            <td class="english-text">{{ $research->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>

</body>
</html>
