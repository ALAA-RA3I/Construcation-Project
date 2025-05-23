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
        Schema::create('consulting_companies', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('focal_point_first_name');
            $table->string('focal_point_last_name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('land_line');
            $table->string('license_number');
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulting_companies');
    }
};
