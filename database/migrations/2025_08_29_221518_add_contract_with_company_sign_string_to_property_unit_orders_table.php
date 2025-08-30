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
            $table->string('contract_company_sign')->nullable();
            // ->after('status') اختياري لتحديد مكان العمود الجديد
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_unit_orders', function (Blueprint $table) {
            $table->dropColumn('contract_company_sign');
        });
    }
};
