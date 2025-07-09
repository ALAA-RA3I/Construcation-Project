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
        Schema::create('project_sales_details', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->string('main_title')->nullable();
            $table->longText('marketing_description')->nullable();
            $table->string('location_link')->nullable();
            $table->string('address')->nullable();
            $table->string('video_url')->nullable();
            $table->string('main_image')->nullable();
            $table->string('diagram_image')->nullable();
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_sales_details');
    }
};
