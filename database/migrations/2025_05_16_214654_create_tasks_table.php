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
        Schema::create('tasks', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->date('dead_line');
            $table->enum('status',['ToDo','Doing','pendeing_approval','Done']);
            $table->boolean('status_of_approval');
            $table->string('type_of_task');
            $table->string('note');
            $table->date('actual_date_of_closed');
            $table->integer('stage_id');
            $table->foreign('stage_id')->references('id')->on('project_stages')->cascadeOnDelete();
            $table->integer('employee_assignded');
            $table->foreign('employee_assignded')->references('id')->on('project_participants')->cascadeOnDelete();
            $table->integer('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('project_participants')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
