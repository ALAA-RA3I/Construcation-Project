<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // تحديث enum الحالة لتشمل جميع الحالات الجديدة
        DB::statement("ALTER TABLE property_unit_orders MODIFY COLUMN status 
        ENUM('pending', 'approved', 'rejected', 'contract_ready', 'payment_pending', 'payment_completed', 'contract_signed', 'contract_finalized') 
        DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // إرجاع enum الحالة إلى الحالة السابقة
        DB::statement("ALTER TABLE property_unit_orders MODIFY COLUMN status 
        ENUM('pending', 'approved', 'rejected') 
        DEFAULT 'pending'");
    }
};
