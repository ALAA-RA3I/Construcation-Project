<?php

namespace App\Http\Controllers\View;

use App\Domain\Services\Contracts\ProjectSalesDetailsServiceInterface;
use App\Http\Controllers\Controller;
use App\Traits\HasFileHandler;

class ProjectSalesDetailsBladeController extends Controller
{
    use HasFileHandler;
    protected $projectSalesDetailsService;

    public function __construct(ProjectSalesDetailsServiceInterface $projectSalesDetailsService)
    {
        $this->projectSalesDetailsService = $projectSalesDetailsService;
    }

    public function index()
    {
        $projects = $this->projectSalesDetailsService->paginate();

        // تعديل روابط الصور والفيديو هنا فقط
        $projects->getCollection()->transform(function ($item) {
            $item->video_url = $item->video_url ? $this->getAssetFileUrl($item->video_url) : null;
            $item->diagram_image = $item->diagram_image ? $this->getAssetFileUrl($item->diagram_image) : null;
            $item->main_image = $item->main_image ? $this->getAssetFileUrl($item->main_image) : null;
            return $item;
        });
        return view('pages.salesSection.units-sales-page',compact('projects'));
    }
    private function getAssetUrlOrNull($path)
    {
        return $path ? $this->getAssetFileUrl($path) : null;
    }
    public function getAll()
    {
        return  $projectSalesDetails = $this->projectSalesDetailsService->getAll();
        // return view('project_sales_details.all', compact('projectSalesDetails'));
    }

    public function show($id)
    {
        return   $projectSalesDetails = $this->projectSalesDetailsService->show($id);
        // return view('project_sales_details.show', compact('projectSalesDetails'));
    }


}
