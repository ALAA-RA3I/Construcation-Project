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
        Schema::create('project_containers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('quantity-available');
            $table->integer('expected-quantity');
            $table->integer('consumed-quantity');
            $table->integer('remaining-quantity');
            $table->integer('required-quantity');
            $table->integer('items_id');
            $table->foreign('items_id')->references('id')->on('items')->cascadeOnDelete();
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_containers');
    }
};
