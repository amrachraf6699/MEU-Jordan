<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل النتاج البحثي</title>
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
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right; /* Right-align text for Arabic */
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style for English text */
        .english-text {
            font-family: Arial, sans-serif; /* English font */
            direction: ltr; /* Left-to-right for English text */
            text-align: left; /* Left-align for English text */
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

    </style>
</head>
<body>

    <htmlpageheader name="page-header">
        <img src="{{ public_path('logo.svg') }}" alt="Logo" style="width: 100px; height: auto;">
    </htmlpageheader>

    <htmlpagefooter name="page-footer">
        <img src="{{ public_path('logo2.jpg') }}" alt="Logo" style="width: 100px; height: auto;">
    </htmlpagefooter>

    <h2 style="margin-top: 30px">تفاصيل النتاج البحثي</h2>
    <h5 style="margin-top: 10px">تم التصدير بواسطة: {{ auth()->user()->full_name }} في {{ now()->format('Y-m-d H:i:s') }}</h5>

    <table>
        <tr>
            <th>العنوان</th>
            <td class="english-text">{{ $research->title }}</td>
        </tr>
        <tr>
            <th>النوع</th>
            <td class="english-text">{{ $research->type }}</td>
        </tr>
        <tr>
            <th>حالة النشر</th>
            <td class="english-text">{{ $research->status }}</td>
        </tr>
        <tr>
            <th>حالة الإعتماد</th>
            <td class="english-text">{{ $research->accreditation_status }}</td>
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
            <td class="english-text">{{ $research->user->full_name ?? 'مستخدم محذوف' }}</td>
        </tr>
        <tr>
            <th>اسم المستخدم</th>
            <td class="english-text">{{ $research->user->username ?? '-' }}</td>
        </tr>
        <tr>
            <th>تاريخ الإنشاء</th>
            <td class="english-text">{{ $research->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <th>تاريخ التحديث</th>
            <td class="english-text">{{ $research->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <th>رابط المنشور البحثي</th>
            <td class="english-text"><a href="{{ $research->publication_link }}" target="_blank">{{ $research->publication_link }}</a></td>
        </tr>
        <tr>
            <th>الأولويات البحثية</th>
            <td class="english-text">{{ $research->priority }}</td>
        </tr>
    </table>

</body>
</html>
