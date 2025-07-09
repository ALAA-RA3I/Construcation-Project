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
        Schema::create('property_units', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('property_book_id');
            $table->foreign('property_book_id')->references('id')->on('property_books')->cascadeOnDelete();
            $table->integer('unit_number');
            $table->integer('floor')->nullable();
            $table->integer('client_id');
            $table->foreign('client_id')->nullable()->references('id')->on('property_books')->cascadeOnDelete();
            $this->addBaseColumns($table);
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_units');
    }
};
