<?php

use App\Domain\Enums\ApproveTaskEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status_of_approval', ApproveTaskEnum::getValues())
                  ->default(ApproveTaskEnum::Pending)
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('status_of_approval')->default(false)->change();
        });
    }
};
