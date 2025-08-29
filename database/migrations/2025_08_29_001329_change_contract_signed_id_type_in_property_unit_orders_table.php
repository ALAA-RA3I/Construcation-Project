<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_unit_orders', function (Blueprint $table) {
            $table->string('contract_signed_id', 100)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('property_unit_orders', function (Blueprint $table) {
            $table->integer('contract_signed_id')->nullable()->change();
        });
    }
};

