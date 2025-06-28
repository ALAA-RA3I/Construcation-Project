<?php

use App\Domain\Enums\ApproveTaskEnum; // استورد الـ Enum الجديد
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // استخدم DB facade للتعامل مع البيانات

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 1. إضافة عمود مؤقت جديد بنوع enum
            // اجعله nullable مؤقتاً لتجنب المشاكل أثناء النقل
            $table->enum('new_status_of_approval', ApproveTaskEnum::getValues())->nullable()->after('status_of_approval');
        });

        // 2. نقل البيانات من العمود القديم (boolean) إلى العمود الجديد (enum)
        // هنا نفترض أن:
        // - TRUE في 'status_of_approval' يعني 'done' في الـ enum.
        // - FALSE في 'status_of_approval' يعني 'pending' في الـ enum.
        // يمكنك تعديل هذا المنطق ليناسب احتياجاتك.
        DB::table('tasks')->where('status_of_approval', true)->update(['new_status_of_approval' => ApproveTaskEnum::Done]);
        DB::table('tasks')->where('status_of_approval', false)->update(['new_status_of_approval' => ApproveTaskEnum::Pending]);

        Schema::table('tasks', function (Blueprint $table) {
            // 3. حذف العمود القديم
            $table->dropColumn('status_of_approval');
        });

        Schema::table('tasks', function (Blueprint $table) {
            // 4. إعادة تسمية العمود الجديد إلى الاسم الأصلي
            $table->renameColumn('new_status_of_approval', 'status_of_approval');
            // إذا كان العمود الأصلي غير قابل للـ null (not nullable)، أعد تعيينه هنا
            // $table->enum('status_of_approval', ApproveTaskEnum::getValues())->nullable(false)->change();
            // بما أننا قمنا بتحويل جميع القيم، فمن الآمن جعله non-nullable إذا كان كذلك في الأصل
            $table->enum('status_of_approval', ApproveTaskEnum::getValues())->change(); // لتأكيد النوع بعد إعادة التسمية
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 1. إضافة عمود مؤقت جديد بنوع boolean للعودة للخلف
            $table->boolean('old_status_of_approval')->nullable()->after('status_of_approval');
        });

        // 2. نقل البيانات من الـ enum إلى الـ boolean للعودة للخلف
        // هنا نعكس المنطق السابق
        DB::table('tasks')->where('status_of_approval', ApproveTaskEnum::Done)->update(['old_status_of_approval' => true]);
        // جميع القيم الأخرى في الـ enum (Pending, InProgress, WaitingForTicket) ستعود إلى FALSE
        DB::table('tasks')
            ->whereIn('status_of_approval', [ApproveTaskEnum::Pending, ApproveTaskEnum::InProgress, ApproveTaskEnum::WaitingForTicket])
            ->update(['old_status_of_approval' => false]);


        Schema::table('tasks', function (Blueprint $table) {
            // 3. حذف عمود الـ enum
            $table->dropColumn('status_of_approval');
        });

        Schema::table('tasks', function (Blueprint $table) {
            // 4. إعادة تسمية العمود القديم إلى الاسم الأصلي
            $table->renameColumn('old_status_of_approval', 'status_of_approval');
            // تأكد من أن يكون العمود غير قابل للـ null إذا كان كذلك في الأصل
            $table->boolean('status_of_approval')->change(); // لتأكيد النوع بعد إعادة التسمية
        });
    }
};
