<?php

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;

trait AddBaseColumnsTrait
{
    public function addBaseColumns(Blueprint $table)
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->timestamps();
        $table->softDeletes();

        $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        $table->foreign('deleted_by')->references('id')->on('users')->nullOnDelete();
    }
}
