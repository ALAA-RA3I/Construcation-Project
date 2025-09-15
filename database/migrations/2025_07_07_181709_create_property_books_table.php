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
        Schema::create('property_books', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->string('model'); // مثل A أو B
            $table->integer('space');
            $table->decimal('price', 12, 2);
            $table->decimal('first_payment_amount', 12, 2)->default(0);
            $table->longText('description')->nullable();
            $table->integer('payment_period')->nullable(); // عدد الأشهر
            $table->integer('available_units')->default(0); // عدد الشقق المتاحة
            $table->integer('number_of_rooms')->nullable();
            $table->integer('number_of_bathrooms')->nullable();
            $table->string('direction')->nullable(); // شرقي، غربي...
            $table->string('diagram_image')->nullable(); // مسار صورة أو ملف PDF
            $this->addBaseColumns($table);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_books');
    }
};
