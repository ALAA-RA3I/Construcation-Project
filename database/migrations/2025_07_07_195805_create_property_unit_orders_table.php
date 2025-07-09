<?php

use App\Domain\Enums\PropertUnitOrderStatusEnum;
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
        Schema::create('property_unit_orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('property_unit_id');
            $table->foreign('property_unit_id')->references('id')->on('property_units')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('identity_file')->nullable(); // صورة أو PDF للهوية
            $table->string('clearance_certificate')->nullable(); // "لا حكم عليه
            $table->enum('status', PropertUnitOrderStatusEnum::getValues())->default(PropertUnitOrderStatusEnum::Pending);
            $table->longText('note');
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propert_unit_orders');
    }
};
