<?php

use App\Domain\Enums\ProgressStatusEnum;
use App\Domain\Enums\PropertyTypeEnum;
use App\Domain\Enums\StatusOfSaleEnum;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('title');
            $table->string('project_code');
            $table->longText('description');
            $table->string('location');
            $table->integer('area');
            $table->integer('number_of_floor');
            $table->enum('status_of_sale', StatusOfSaleEnum::getValues())->default(StatusOfSaleEnum::NotForSale);
            $table->date('expected_date_of_completed');
            $table->enum('type', PropertyTypeEnum::getValues())->default(PropertyTypeEnum::Commercial);
            $table->enum('progress_status', ProgressStatusEnum::getValues())->default(ProgressStatusEnum::Initial);
            $table->integer('expected_cost');
            $table->integer('owner_id');
            $table->foreign('owner_id')->references('id')->on('owners')->cascadeOnDelete();
            $table->integer('consulting_company_id');
            $table->foreign('consulting_company_id')->references('id')->on('consulting_companies')->cascadeOnDelete();
            $this->addBaseColumns($table);
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
