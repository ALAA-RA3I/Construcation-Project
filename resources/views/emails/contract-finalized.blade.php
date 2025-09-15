<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم توقيع العقد بنجاح</title>
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

        .success-banner {
            background-color: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 30px 0;
        }

        .download-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }

        .download-button:hover {
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

        .contract-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .blockchain-info {
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
            <div class="logo">🎉 شركة العقارات</div>
            <h1 class="title">تم توقيع العقد بنجاح!</h1>
        </div>

        <div class="content">
            <p>مرحباً {{ $client->first_name }} {{ $client->last_name }}،</p>

            <div class="success-banner">
                🎊 تهانينا! تم توقيع العقد بنجاح 🎊
            </div>

            <p>تم توقيع العقد من كلا الطرفين وتم رفعه على البلوك تشين للحماية. أصبح العقد الآن ساري المفعول!</p>

            <div class="contract-details">
                <strong>تفاصيل العقد:</strong><br>
                رقم العقد: #{{ $order->id }}<br>
                تاريخ التوقيع: {{ $order->company_signed_at->format('Y-m-d H:i') }}<br>
                رقم الوحدة: {{ $propertyUnit->unit_number }}<br>
                الطابق: {{ $propertyUnit->floor ?? 'غير محدد' }}<br>
                المساحة: {{ $propertyUnit->propertyBook->space }} متر مربع<br>
                السعر: {{ number_format($propertyUnit->propertyBook->price) }} دولار
            </div>

            <div class="blockchain-info">
                <strong>🔗 معلومات البلوك تشين:</strong><br>
                تم رفع العقد على البلوك تشين بنجاح<br>
                Hash العقد: <code>{{ $order->contract_hash }}</code><br>
                يمكنك التحقق من صحة العقد عبر هذا الـ Hash
            </div>

            <p><strong>الخطوات التالية:</strong></p>
            <ol>
                <li>تحميل نسخة من العقد النهائي</li>
                <li>حفظ العقد في مكان آمن</li>
                <li>الاستعداد لاستلام المفاتيح</li>
                <li>التواصل مع إدارة المبنى للترتيبات النهائية</li>
            </ol>

            <div style="text-align: center;">
                <a href="{{ url('/api/contracts/' . $order->id . '/download') }}"
                    class="download-button">
                    تحميل العقد النهائي
                </a>
            </div>

            <p><strong>معلومات مهمة:</strong></p>
            <ul>
                <li>العقد محمي على البلوك تشين ولا يمكن تعديله</li>
                <li>يمكنك تحميل نسخة من العقد في أي وقت</li>
                <li>سيتم التواصل معك قريباً لترتيب استلام المفاتيح</li>
                <li>مرحباً بك في منزلك الجديد! 🏠</li>
            </ul>
        </div>

        <div class="footer">
            <p>شكراً لك على ثقتك بنا</p>
            <p>© {{ date('Y') }} شركة العقارات. جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>

</html>