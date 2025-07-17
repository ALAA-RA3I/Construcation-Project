<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProjectSalesDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $projectId) {
            DB::table('project_sales_details')->insert([
                'project_id' => $projectId,
                'main_title' => "عنوان المشروع رقم $projectId",
                'marketing_description' => "وصف تسويقي تجريبي للمشروع رقم $projectId. هذا مجرد نص تجريبي.",
                'location_link' => "https://maps.google.com/?q=location+$projectId",
                'address' => "عنوان المشروع رقم $projectId",
                'video_url' => "https://example.com/video$projectId.mp4",
                'main_image' => "main_image_$projectId.jpg",
                'diagram_image' => "diagram_image_$projectId.png",
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
