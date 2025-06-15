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
        Schema::create('project_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('years_of_experience')->nullable();
            $table->text('bio')->nullable();
            // Add more fields as needed
            $this->addBaseColumns($table); // If you're using a trait for created_by, timestamps, etc.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_managers');
    }
};
