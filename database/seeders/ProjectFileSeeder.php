<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str; 

class ProjectFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 $faker = Faker::create('en_US'); // يمكنك استخدام 'ar_SA' إذا كنت تفضل بيانات عربية

        // قائمة بامتدادات ملفات شائعة لتوليد مسارات واقعية
        $extensions = ['pdf', 'docx', 'xlsx', 'jpg', 'png', 'zip'];

        // مسار المجلد الافتراضي كما هو في دالة storeFile
        $directory = 'uploads';

        // Loop to create 10 fake project files
        for ($i = 0; $i < 10; $i++) {
            // توليد اسم ملف فريد باستخدام UUID وامتداد عشوائي
            $uniqueFileName = Str::uuid() . '.' . $faker->randomElement($extensions);
            $filePath = $directory . '/' . $uniqueFileName;

            DB::table('project_files')->insert([
                'file_path' => $filePath,
                'description' => $faker->sentence(5), // وصف وهمي للملف
                'project_id' => 1, // كما طلبت
                'project_participant_id' => 1, // كما طلبت
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }    }

