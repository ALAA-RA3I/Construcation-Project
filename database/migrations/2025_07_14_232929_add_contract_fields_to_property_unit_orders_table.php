<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('property_unit_orders', function (Blueprint $table) {
            // حقول العقد
            $table->string('contract_file')->nullable(); // ملف العقد
            $table->string('contract_hash')->nullable(); // hash العقد للبلوك تشين
            $table->timestamp('contract_sent_at')->nullable(); // تاريخ إرسال العقد

            // حقول التوقيع
            $table->string('signature_code')->nullable(); // رمز التوقيع السري
            $table->timestamp('signature_code_sent_at')->nullable(); // تاريخ إرسال رمز التوقيع
            $table->timestamp('client_signed_at')->nullable(); // تاريخ توقيع العميل
            $table->timestamp('company_signed_at')->nullable(); // تاريخ توقيع الشركة

            // حقول الدفع
            $table->string('payment_intent_id')->nullable(); // Stripe Payment Intent ID
            $table->decimal('payment_amount', 12, 2)->nullable(); // مبلغ الدفع
            $table->timestamp('payment_completed_at')->nullable(); // تاريخ اكتمال الدفع

            // حقول إضافية
            $table->string('activation_token')->nullable(); // رمز تفعيل الحساب
            $table->timestamp('activation_token_sent_at')->nullable(); // تاريخ إرسال رمز التفعيل
            $table->timestamp('account_activated_at')->nullable(); // تاريخ تفعيل الحساب
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_unit_orders', function (Blueprint $table) {
            $table->dropColumn([
                'contract_file',
                'contract_hash',
                'contract_sent_at',
                'signature_code',
                'signature_code_sent_at',
                'client_signed_at',
                'company_signed_at',
                'payment_intent_id',
                'payment_amount',
                'payment_completed_at',
                'activation_token',
                'activation_token_sent_at',
                'account_activated_at'
            ]);
        });
    }
};
