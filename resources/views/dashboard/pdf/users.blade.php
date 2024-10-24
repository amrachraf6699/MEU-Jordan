<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستخدمين النظام</title>
    <style>
        @font-face {
            font-family: 'KFGQPC Uthman Taha Naskh';
        }

        body {
            font-family: 'KFGQPC Uthman Taha Naskh', Arial, sans-serif; /* Arabic font with fallbacks */
            direction: rtl; /* Right to Left for Arabic */
            text-align: right; /* Right-align text */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000; /* Cell borders */
            padding: 10px;
            text-align: right; /* Right-align text */
        }

        th {
            background-color: #4CAF50; /* Header background color */
            color: white; /* Header text color */
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra stripe effect */
        }

        /* Optional: Apply a different font for English text */
        .english {
            font-family: Arial, sans-serif; /* Fallback font for English */
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">قائمة المستخدمين</h1>
    <table>
        <thead>
            <tr>
                <th>الاسم الكامل</th>
                <th>اسم المستخدم</th>
                <th>رقم الموظف</th>
                <th>الدور</th>
                <th>القسم</th>
                <th>البرنامج</th>
                <th>عدد الأبحاث</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user['full_name'] }}</td>
                    <td class="english">{{ $user['username'] }}</td> <!-- English text with a different font -->
                    <td class="english">{{ $user['employee_number'] }}</td> <!-- English text with a different font -->
                    <td>{{ $user['role'] }}</td>
                    <td>{{ $user['department'] }}</td>
                    <td>{{ $user['program'] }}</td>
                    <td class="english">{{ $user['researches_count'] }}</td> <!-- English text with a different font -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
