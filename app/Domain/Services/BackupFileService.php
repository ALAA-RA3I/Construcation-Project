<?php

namespace App\Domain\Services;

use App\Application\DTO\BackupfileDTO\BackupfileDTO;
use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\BackupFileRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectFileRepositoryInterface;
use App\Domain\Services\Contracts\BackupFileServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class BackupFileService implements BackupFileServiceInterface
{
    use HasFileHandler;
    protected $backupFileRepo;
    protected $projectFileRepo;

    public function __construct(BackupFileRepositoryInterface $backupFileRepo, ProjectFileRepositoryInterface $projectFileRepo)
    {
        $this->backupFileRepo = $backupFileRepo;
        $this->projectFileRepo = $projectFileRepo;
    }

    public function getAll($projectId)
    {
        return $this->backupFileRepo->query()
            ->whereHas('projectFile', function ($query) use ($projectId) {
                $query->where('project_id', $projectId);
            })
            ->get();
    }


    public function paginate()
    {
        return $this->backupFileRepo->paginate();
    }

    public function create(BackupfileDTO $dto,$id)
    {
        return DB::transaction(function () use ($dto, $id) {
        $fileSelected =$this->projectFileRepo->find($id);

        if (!$fileSelected) {
            throw new \Exception("Project file not found.");
        }

        $oldFilePath = $fileSelected->file_path;

        $newFilePath = $this->updateFileWithBackup(
            $dto->file,      
            $oldFilePath,     
            'uploads',       
            'public',         
            'backups'         
        );

        $this->backupFileRepo->create([
            'project_file_id' =>  $fileSelected->id,
            'path' => $fileSelected->file_path,
            'version' => $dto->version
        ]);

         $updatedData = [
            'file_path' => $newFilePath 
        ];

        $fileSelected->update($updatedData);
        });
    }

    public function show($id)
    {
        return $this->backupFileRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->backupFileRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->backupFileRepo->delete($id);
    }
}