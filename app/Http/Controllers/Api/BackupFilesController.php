<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\BackupfileDTO\BackupfileDTO;
use App\Domain\Services\Contracts\BackupFileServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackupFile\CreateBackupFileRequest;
use App\Http\Resources\BackupFileResource;
use Illuminate\Http\Request;


class BackupFilesController extends Controller
{
    protected $backupFileService;

    public function __construct(BackupFileServiceInterface $backupFileService)
    {
        $this->backupFileService = $backupFileService;
    }

    public function getAll($projectId) {
        $files = $this->backupFileService->getAll($projectId);
        return ApiResponse::success(BackupFileResource::collection($files));
    }

    public function show($id) {
        $file = $this->backupFileService->show($id);
        return ApiResponse::success(BackupFileResource::make($file));
    }

    public function create(CreateBackupFileRequest $data,$id) {
        $validatedData = BackupfileDTO::fromCreateRequest($data->validated());
        $this->backupFileService->create($validatedData,$id);
        return ApiResponse::success(null,'Files updated successfully');
    }
}
