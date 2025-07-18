<?php

namespace App\Http\Controllers;

use App\Application\DTO\ProjectSalesDetailsDTO\ProjectSalesDetailsDTO;
use App\Domain\Services\Contracts\ProjectSalesDetailsServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectSalesDetails\CreateProjectSalesDetailsRequest;
use App\Http\Requests\ProjectSalesDetails\UpdateProjectSalesDetailsRequest;
use Illuminate\Http\Request;

class ProjectSalesDetailsBladeController extends Controller
{
    protected $projectSalesDetailsService;

    public function __construct(ProjectSalesDetailsServiceInterface $projectSalesDetailsService)
    {
        $this->projectSalesDetailsService = $projectSalesDetailsService;
    }

    public function index()
    {
      return   $projectSalesDetails = $this->projectSalesDetailsService->paginate();
        // return view('project_sales_details.index', compact('projectSalesDetails'));
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
