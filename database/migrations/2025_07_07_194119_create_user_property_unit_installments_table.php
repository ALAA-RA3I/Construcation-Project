<?php

use App\Traits\AddBaseColumnsTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use AddBaseColumnsTrait;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_property_unit_installments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('property_unit_id');
            $table->foreign('property_unit_id')->references('id')->on('property_units')->cascadeOnDelete();
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->decimal('amount', 12, 2); // قيمة القسط
            $table->date('due_date'); // تاريخ الاستحقاق
            $table->boolean('is_paid')->default(false);
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_property_unit_installments');
    }
};
