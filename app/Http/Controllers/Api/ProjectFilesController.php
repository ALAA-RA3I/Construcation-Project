<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectFilesDTO\projectFileDTO;
use App\Domain\Services\Contracts\ProjectFileServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFiles\CreateProjectFileRequest;
use App\Http\Requests\ProjectFiles\UpdateProjectFilesRequest;
use App\Http\Resources\ProjectFileResource;

class ProjectFilesController extends Controller
{
    protected $fileService;

    public function __construct(ProjectFileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getAllProjectFiles($id) 
    {
        $files = $this->fileService->getAllProjectFiles($id);
        return ApiResponse::success(ProjectFileResource::collection($files));
    }

    public function show($id) 
    {
        $file = $this->fileService->show($id);
        return ApiResponse::success(ProjectFileResource::make($file));    
    }

    public function paginate($id) 
    {
        $files = $this->fileService->paginate($id);
        return ApiResponse::success(ProjectFileResource::collection($files));
    }

    public function delete($id)
    {
        $deleted = $this->fileService->delete($id);
        if(!$deleted) {
            return ApiResponse::error('Something went wrong');
        }return ApiResponse::success('','Deleted successfully',200);
    }

    public function create(CreateProjectFileRequest $data,$id) 
    {
        $validatedData = projectFileDTO::fromCreateRequest($data->validated());
        $file = $this->fileService->create($validatedData,$id);
        if (!$file) {
            return ApiResponse::error('File upload failed.');
        }
        return ApiResponse::success(new ProjectFileResource($file));
    }

    // public function update(UpdateProjectFilesRequest $data, $id) 
    // {
    //     $validatedData = projectFileDTO::fromUpdateRequest($data->validated());
    //     $file = $this->fileService->update($id , $validatedData);
    //     if(!$file)
    //         return ApiResponse::error('File Update failed.');
    //     return ApiResponse::success('File Updated successfully');
    // }
}
