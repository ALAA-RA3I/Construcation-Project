<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\PropertyUnitOrder;
use App\Domain\Services\ContractServiceService;
use App\Domain\Services\Contracts\ContractServiceServiceInterface;
use Illuminate\Support\Facades\Storage;

echo "=== إنشاء عقد حقيقي ===\n\n";

try {
    // البحث عن طلب موجود
    $order = PropertyUnitOrder::with(['client', 'propertyUnit.propertyBook'])->find(6);

    if (!$order) {
        echo "❌ لا يوجد طلب برقم 6. يرجى إنشاء طلب أولاً.\n";
        exit;
    }

    echo "📋 تفاصيل الطلب:\n";
    echo "   رقم الطلب: #{$order->id}\n";
    echo "   العميل: {$order->client->first_name} {$order->client->last_name}\n";
    echo "   الوحدة: #{$order->propertyUnit->unit_number}\n";
    echo "   الحالة الحالية: {$order->status}\n\n";

    // إنشاء خدمة العقد
    $contractService = new ContractServiceService();

    // إنشاء العقد
    echo "🔄 إنشاء العقد...\n";
    $contractFile = $contractService->generateContract($order);

    echo "✅ تم إنشاء العقد بنجاح!\n";
    echo "   مسار الملف: {$contractFile}\n";
    echo "   المسار الكامل: " . storage_path('app/public/' . $contractFile) . "\n";
    echo "   رابط الوصول: " . asset('storage/' . $contractFile) . "\n\n";

    // التحقق من وجود الملف
    if (Storage::disk('public')->exists($contractFile)) {
        echo "✅ الملف موجود في التخزين\n";
        $fileSize = Storage::disk('public')->size($contractFile);
        echo "   حجم الملف: {$fileSize} bytes\n";
    } else {
        echo "❌ الملف غير موجود في التخزين\n";
    }

    // عرض محتوى العقد
    echo "\n📄 محتوى العقد:\n";
    echo "----------------------------------------\n";
    $content = Storage::disk('public')->get($contractFile);
    echo $content;
    echo "\n----------------------------------------\n";
} catch (Exception $e) {
    echo "❌ خطأ: " . $e->getMessage() . "\n";
    echo "الخط: " . $e->getLine() . "\n";
}
