<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفعيل حسابك</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #007bff;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .title {
            color: #333;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 30px;
        }

        .activation-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }

        .activation-button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }

        .highlight {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🏢 شركة العقارات</div>
            <h1 class="title">تفعيل حسابك</h1>
        </div>

        <div class="content">
            <p>مرحباً {{ $client->first_name }} {{ $client->last_name }}،</p>

            <p>شكراً لك على طلب الشقة. تم قبول طلبك من قبل إدارة الشركة!</p>

            <div class="highlight">
                <strong>تفاصيل الطلب:</strong><br>
                رقم الطلب: #{{ $order->id }}<br>
                تاريخ الطلب: {{ $order->created_at->format('Y-m-d') }}
            </div>

            <p>لتفعيل حسابك والبدء في عملية توقيع العقد، يرجى الضغط على الرابط أدناه:</p>

            <div style="text-align: center;">
                <a href="{{ url('/api/contract-flow/activate-account?token=' . $activationToken) }}"
                    class="activation-button">
                    تفعيل حسابي
                </a>
            </div>

            <p><strong>ملاحظة مهمة:</strong></p>
            <ul>
                <li>هذا الرابط صالح لمدة 24 ساعة فقط</li>
                <li>بعد التفعيل، ستتلقى إيميلاً آخر يحتوي على العقد</li>
                <li>يمكنك مراجعة العقد والتوقيع عليه إلكترونياً</li>
            </ul>
        </div>

        <div class="footer">
            <p>إذا لم تقم بطلب هذه الشقة، يرجى تجاهل هذا الإيميل</p>
            <p>© {{ date('Y') }} شركة العقارات. جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>

</html>