<?php

namespace App\Domain\Services;

use App\Infrastructure\Repositories\Contracts\ProjectFileRepositoryInterface;
use App\Domain\Services\Contracts\ProjectFileServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Support\Facades\Log;

class ProjectFileService implements ProjectFileServiceInterface
{
    use HasFileHandler;
    protected $projectFileRepo;

    public function __construct(ProjectFileRepositoryInterface $projectFileRepo)
    {
        $this->projectFileRepo = $projectFileRepo;
    }

    public function getAll()
    {
        // return $this->projectFileRepo->all();
    }

    public function getAllProjectFiles($id) 
    {
        return $this->projectFileRepo->findWhere(['project_id' => $id]);
    }

    public function paginate($id)
    {
        return $this->projectFileRepo->scopeQuery(function ($query) use ($id) {
            return $query->where('project_id', $id);
        })->paginate();
    }

    public function create(array $data, $id)
    {
        $storedPath = $this->storeFile($data['file'], 'uploads', 'public');

        if (!$storedPath) {
            Log::error("File storage failed.");
            return false;
        }

        $data['file_path'] = $storedPath;
        $data['project_id'] = $id;
        $data['file_path'] = $storedPath;
        $data['project_participant_id'] = 1; 

        return $this->projectFileRepo->create($data);
    }

    public function show($id)
    {
        return $this->projectFileRepo->find($id);
    }

    public function update($id, array $data)
    {
        // return $this->projectFileRepo->update($data, $id);
    }

    public function delete($id)
    {
        $file = $this->projectFileRepo->find($id);
        $filePath = $file->file_path;
        if(!$this->fileExists($filePath))
            return false;
        $this->deleteFile($filePath);
        return $this->projectFileRepo->delete($id);
    }
}