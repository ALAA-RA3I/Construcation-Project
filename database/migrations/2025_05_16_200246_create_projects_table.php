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
        Schema::create('projects', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('title');
            $table->string('project_code');
            $table->longText('description');
            $table->string('location');
            $table->integer('area');
            $table->integer('number_of_floor');
            $table->enum('stauts_of_sale',['salesable','unsalesable']);
            $table->date('expected_date_of_completed');
            $table->enum('type',['Commercial','Residential']);
            $table->enum('progress_status',['initial','execuation','Done']);
            $table->integer('expected_cost');
            $table->integer('owner_id');
            $table->foreign('owner_id')->references('id')->on('owners')->cascadeOnDelete();
            $table->integer('consulting_company_id');
            $table->foreign('consulting_company_id')->references('id')->on('consulting_companies')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
