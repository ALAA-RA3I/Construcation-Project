<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\PropertyUnitOrder;
use App\Models\Client;
use App\Models\PropertyUnit;
use App\Domain\Enums\PropertUnitOrderStatusEnum;

echo "=== اختبار تدفق العقد ===\n\n";

try {
    // 1. إنشاء طلب جديد
    echo "1. إنشاء طلب جديد...\n";

    // البحث عن عميل موجود
    $client = Client::first();
    if (!$client) {
        echo "❌ لا يوجد عملاء في النظام. يرجى إنشاء عميل أولاً.\n";
        exit;
    }

    // البحث عن وحدة عقارية موجودة
    $propertyUnit = PropertyUnit::first();
    if (!$propertyUnit) {
        echo "❌ لا توجد وحدات عقارية في النظام. يرجى إنشاء وحدة أولاً.\n";
        exit;
    }

    // إنشاء طلب جديد
    $order = PropertyUnitOrder::create([
        'property_unit_id' => $propertyUnit->id,
        'client_id' => $client->id,
        'status' => PropertUnitOrderStatusEnum::Pending,
        'note' => 'طلب تجريبي للاختبار'
    ]);

    echo "✅ تم إنشاء الطلب برقم: #{$order->id}\n";
    echo "   العميل: {$client->first_name} {$client->last_name}\n";
    echo "   الوحدة: #{$propertyUnit->unit_number}\n";
    echo "   الحالة: {$order->status}\n\n";

    // 2. الموافقة على الطلب
    echo "2. الموافقة على الطلب...\n";
    $order->update(['status' => PropertUnitOrderStatusEnum::Approved]);
    echo "✅ تمت الموافقة على الطلب\n";
    echo "   الحالة الجديدة: {$order->status}\n\n";

    // 3. إنشاء رمز التفعيل
    echo "3. إنشاء رمز التفعيل...\n";
    $activationToken = \Illuminate\Support\Str::random(64);
    $order->update([
        'activation_token' => $activationToken,
        'activation_token_sent_at' => now()
    ]);
    echo "✅ تم إنشاء رمز التفعيل\n";
    echo "   الرمز: {$activationToken}\n\n";

    // 4. تفعيل الحساب
    echo "4. تفعيل الحساب...\n";
    $order->update([
        'account_activated_at' => now(),
        'status' => PropertUnitOrderStatusEnum::ContractReady
    ]);
    echo "✅ تم تفعيل الحساب\n";
    echo "   الحالة الجديدة: {$order->status}\n\n";

    // 5. إنشاء العقد
    echo "5. إنشاء العقد...\n";
    $contractFile = 'contracts/contract_' . $order->id . '_' . time() . '.pdf';
    $order->update([
        'contract_file' => $contractFile,
        'contract_sent_at' => now()
    ]);
    echo "✅ تم إنشاء العقد\n";
    echo "   ملف العقد: {$contractFile}\n\n";

    // 6. إنشاء رمز التوقيع
    echo "6. إنشاء رمز التوقيع...\n";
    $signatureCode = \Illuminate\Support\Str::random(6);
    $order->update([
        'signature_code' => $signatureCode,
        'signature_code_sent_at' => now()
    ]);
    echo "✅ تم إنشاء رمز التوقيع\n";
    echo "   الرمز: {$signatureCode}\n\n";

    // 7. إنشاء Payment Intent
    echo "7. إنشاء Payment Intent...\n";
    $paymentAmount = 1000.00;
    $paymentIntentId = 'pi_test_' . time();
    $order->update([
        'payment_intent_id' => $paymentIntentId,
        'payment_amount' => $paymentAmount,
        'status' => PropertUnitOrderStatusEnum::PaymentPending
    ]);
    echo "✅ تم إنشاء Payment Intent\n";
    echo "   المبلغ: {$paymentAmount} دولار\n";
    echo "   Payment Intent ID: {$paymentIntentId}\n";
    echo "   الحالة الجديدة: {$order->status}\n\n";

    // 8. تأكيد الدفع
    echo "8. تأكيد الدفع...\n";
    $order->update([
        'payment_completed_at' => now(),
        'status' => PropertUnitOrderStatusEnum::PaymentCompleted
    ]);
    echo "✅ تم تأكيد الدفع\n";
    echo "   الحالة الجديدة: {$order->status}\n\n";

    // 9. توقيع العميل
    echo "9. توقيع العميل...\n";
    $order->update([
        'client_signed_at' => now(),
        'status' => PropertUnitOrderStatusEnum::ContractSigned
    ]);
    echo "✅ تم توقيع العميل\n";
    echo "   الحالة الجديدة: {$order->status}\n\n";

    // 10. توقيع الشركة
    echo "10. توقيع الشركة...\n";
    $contractHash = hash('sha256', json_encode([
        'order_id' => $order->id,
        'client_id' => $order->client_id,
        'property_unit_id' => $order->property_unit_id,
        'contract_file' => $order->contract_file,
        'client_signed_at' => $order->client_signed_at,
        'company_signed_at' => now(),
        'timestamp' => now()->timestamp
    ]));

    $order->update([
        'company_signed_at' => now(),
        'contract_hash' => $contractHash,
        'status' => PropertUnitOrderStatusEnum::ContractFinalized
    ]);
    echo "✅ تم توقيع الشركة\n";
    echo "   Hash العقد: {$contractHash}\n";
    echo "   الحالة النهائية: {$order->status}\n\n";

    // عرض النتيجة النهائية
    echo "=== النتيجة النهائية ===\n";
    echo "رقم الطلب: #{$order->id}\n";
    echo "العميل: {$client->first_name} {$client->last_name}\n";
    echo "الوحدة: #{$propertyUnit->unit_number}\n";
    echo "الحالة: {$order->status}\n";
    echo "تاريخ التوقيع: {$order->company_signed_at}\n";
    echo "Hash العقد: {$order->contract_hash}\n";
    echo "مبلغ الدفع: {$order->payment_amount} دولار\n";
    echo "رمز التوقيع المستخدم: {$signatureCode}\n";

    echo "\n🎉 تم إكمال تدفق العقد بنجاح!\n";
} catch (Exception $e) {
    echo "❌ خطأ: " . $e->getMessage() . "\n";
    echo "الخط: " . $e->getLine() . "\n";
}
