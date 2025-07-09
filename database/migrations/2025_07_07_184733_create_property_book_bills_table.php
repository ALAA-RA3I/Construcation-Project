<?php

use App\Domain\Enums\BookBillTypeEnum;
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
        Schema::create('property_book_bills', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('property_book_id');
            $table->foreign('property_book_id')->references('id')->on('property_books')->cascadeOnDelete();
            $table->decimal('amount', 12, 2); // قيمة القسط
            $table->integer('due_in_months')->nullable(); // بعد كم شهر من بداية العقد يستحق القسط (مثلاً 0 = دفعة أولى، 1 = بعد شهر)
            $table->enum('type', BookBillTypeEnum::getValues())->default(BookBillTypeEnum::Monthly);

            $table->string('description')->nullable(); // وصف القسط (اختياري)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_book_bills');
    }
};
