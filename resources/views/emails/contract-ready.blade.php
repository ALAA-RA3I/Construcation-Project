<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عقدك جاهز للمراجعة والتوقيع</title>
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
            border-bottom: 2px solid #28a745;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
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

        .contract-button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }

        .contract-button:hover {
            background-color: #218838;
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
            background-color: #d4edda;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
        }

        .property-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🏢 شركة العقارات</div>
            <h1 class="title">عقدك جاهز للمراجعة الدفع والتوقيع</h1>
        </div>

        <div class="content">
            <p>مرحباً {{ $client->first_name }} {{ $client->last_name }}،</p>

            <p>تم إعداد عقد الشقة الخاصة بك وجاهز للمراجعة والدفع والتوقيع!</p>

            <div class="highlight">
                <strong>🎉 تهانينا!</strong><br>
                تم قبول طلبك وتم إعداد العقد بنجاح
            </div>

            <div class="property-details">
                <p><strong>مرفقات:</strong></p>
                <p>- نسخة من العقد (PDF)</p>
            </div>
          
            <p><strong>الخطوات التالية:</strong></p>
            <ol>
                <li>مراجعة العقد بعناية</li>
                <li>إتمام عملية الدفع</li>
                <li>التوقيع على العقد باستخدام التوقيع الرقمي</li>
                <li>استلام العقد النهائي</li>
            </ol>

            <div style="text-align: center;">
                <a href="{{ url('/dashboard/contracts/' . $order->id) }}"
                    class="contract-button">
                    عرض العقد والتوقيع
                </a>
            </div>

            <p><strong>معلومات مهمة:</strong></p>
            <ul>
                 <li>يجب إتمام الدفع قبل التوقيع على العقد</li>
                <li>العقد سيتم رفعه على البلوك تشين للحماية</li>
                <li>يمكنك تحميل نسخة من العقد النهائي</li>
            </ul>
        </div>

        <div class="footer">
            <p>إذا كان لديك أي استفسارات، لا تتردد في التواصل معنا</p>
            <p>© {{ date('Y') }} شركة العقارات. جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>

</html>