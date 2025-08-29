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
        Schema::create('clients', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number');
            $table->bigInteger('national_id');
            $table->string('api_token');
            //added device token in new migration  $table->string('device_token')->nullable();

            $table->boolean('is_active')->default(1);

            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
