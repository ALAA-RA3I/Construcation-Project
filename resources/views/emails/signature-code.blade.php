<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رمز التوقيع السري</title>
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
            border-bottom: 2px solid #dc3545;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #dc3545;
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

        .signature-code {
            background-color: #f8d7da;
            border: 2px solid #dc3545;
            color: #721c24;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 5px;
            margin: 30px 0;
            font-family: 'Courier New', monospace;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }

        .warning {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }

        .steps {
            background-color: #e7f3ff;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🔐 شركة العقارات</div>
            <h1 class="title">رمز التوقيع السري</h1>
        </div>

        <div class="content">
            <p>مرحباً {{ $client->first_name }} {{ $client->last_name }}،</p>

            <p>تم إرسال رمز التوقيع السري الخاص بك لتوقيع العقد:</p>

            <div class="signature-code">
                {{ $signatureCode }}
            </div>

            <div class="steps">
                <strong>خطوات التوقيع:</strong>
                <ol>
                    <li>اذهب إلى صفحة العقد</li>
                    <li>أدخل الرمز السري أعلاه</li>
                    <li>اضغط على "توقيع العقد"</li>
                    <li>ستتلقى تأكيداً على توقيعك</li>
                </ol>
            </div>

            <div class="warning">
                <strong>⚠️ تحذير مهم:</strong>
                <ul>
                    <li>لا تشارك هذا الرمز مع أي شخص</li>
                    <li>الرمز صالح لمدة ساعة واحدة فقط</li>
                    <li>إذا انتهت صلاحية الرمز، يمكنك طلب رمز جديد</li>
                    <li>التوقيع نهائي ولا يمكن التراجع عنه</li>
                </ul>
            </div>

            <p><strong>تفاصيل الطلب:</strong></p>
            <ul>
                <li>رقم الطلب: #{{ $order->id }}</li>
                <li>تاريخ الإرسال: {{ now()->format('Y-m-d H:i') }}</li>
                <li>صالح حتى: {{ now()->addHour()->format('Y-m-d H:i') }}</li>
            </ul>
        </div>

        <div class="footer">
            <p>إذا لم تطلب هذا الرمز، يرجى تجاهل هذا الإيميل</p>
            <p>© {{ date('Y') }} شركة العقارات. جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>

</html>