<?php

use App\Domain\Enums\TaskStatusEnum;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->date('dead_line');
            $table->enum('status', TaskStatusEnum::getValues())->default(TaskStatusEnum::ToDo);
            $table->boolean('status_of_approval');
            $table->string('type_of_task');
            $table->string('note');
            $table->date('actual_date_of_closed');
            $table->integer('stage_id');
            $table->foreign('stage_id')->references('id')->on('project_stages')->cascadeOnDelete();
            $table->integer('employee_assigned');
            $table->foreign('employee_assigned')->references('id')->on('project_participants')->cascadeOnDelete();
            $table->integer('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('project_participants')->cascadeOnDelete();
            $this->addBaseColumns($table);
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
