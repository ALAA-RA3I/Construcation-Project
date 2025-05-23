<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ConsultingCompanyDTO\ConsultingCompanyDTO;
use App\Domain\Services\Contracts\ConsultingCompanyServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultingCompany\CreateConsultingCompanyRequest;
use App\Http\Requests\ConsultingCompany\UpdateConsultingCompanyRequest;
use App\Http\Requests\ConsultingEngineer\UpdateConsultingEngineerRequest;
use App\Http\Resources\ConsultingCompanyResource;
use Illuminate\Http\Request;

class ConsultingCompanyController extends Controller
{
    private $consCompanyService;

    public function __construct(ConsultingCompanyServiceInterface $Service)
    {
        $this->consCompanyService = $Service;
    }

    public function getAll() {
        $consCompanies = $this->consCompanyService->getAll();
        return ApiResponse::success(ConsultingCompanyResource::collection($consCompanies));
    }

    public function index() {
        $consCompanies = $this->consCompanyService->paginate();
        return ApiResponse::success(ConsultingCompanyResource::collection($consCompanies));
    }

    public function show($id) {
        $consCompany = $this->consCompanyService->show($id);
        return ApiResponse::success(ConsultingCompanyResource::make($consCompany));
    }

    public function create(CreateConsultingCompanyRequest $data) {
        $validatedData = ConsultingCompanyDTO::fromCreateRequest($data->validated());
        $consCompany = $this->consCompanyService->create($validatedData);
        return ApiResponse::success(new ConsultingCompanyResource($consCompany), 'New Consulting Company Added', 201);
    }

    public function update(UpdateConsultingCompanyRequest  $data, $id) {
        $validatedData = ConsultingCompanyDTO::fromUpdateRequest($data->validated());
        $updated = $this->consCompanyService->update($id, $validatedData);

        if(!$updated) {
            return ApiResponse::error('Failed update information',404);
        }
        return ApiResponse::success('Information updated successfully',201);
    }

    public function delete($id) {
        $deleted = $this->consCompanyService->delete($id);
        if (!$deleted) {
            return ApiResponse::error('Engineer not deleted', 404);
        } return ApiResponse::success(null, 'Company deleted successfully');
    }

}
