<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectNewsRepositoryInterface;
use App\Domain\Services\Contracts\ProjectNewsServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectNewsService implements ProjectNewsServiceInterface
{
    use HasFileHandler;
    protected $projectNewsRepo;

    public function __construct(ProjectNewsRepositoryInterface $projectNewsRepo)
    {
        $this->projectNewsRepo = $projectNewsRepo;
    }

    public function getAll()
    {
        $this->projectNewsRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->projectNewsRepo->all();
    }

    public function paginate()
    {
        $this->projectNewsRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->projectNewsRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Handle path_file upload
            if (isset($data['path_file']) && $data['path_file'] instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $this->storeFile($data['path_file'], 'project-news', 'public');
                if (!$filePath) {
                    Log::error("File storage failed for project news.");
                    DB::rollBack();
                    return false;
                }
                $data['path_file'] = $filePath;
            }

            $projectNews = $this->projectNewsRepo->create($data);
            DB::commit();
            return $projectNews->load(['project']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $projectNews = $this->projectNewsRepo->pushCriteria(new WithRelationsCriteria(['project']))->find($id);
        return $projectNews;
    }

    public function update($id, array $data)
    {
        try {
            $projectNews = $this->projectNewsRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project News not found');
        }

        // Handle path_file upload
        if (isset($data['path_file']) && $data['path_file'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old file if exists
            if ($projectNews->path_file && $this->fileExists($projectNews->path_file)) {
                $this->deleteFile($projectNews->path_file);
            }

            $filePath = $this->storeFile($data['path_file'], 'project-news', 'public');
            if (!$filePath) {
                Log::error("File storage failed during update for project news.");
                return false;
            }
            $data['path_file'] = $filePath;
        }

        $this->projectNewsRepo->update($data, $id);
        return $projectNews->fresh()->load(['project']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $projectNews = $this->projectNewsRepo->find($id);

            if (!$projectNews) {
                return false;
            }

            // Delete associated file
            if ($projectNews->path_file && $this->fileExists($projectNews->path_file)) {
                $this->deleteFile($projectNews->path_file);
            }

            // Soft delete the project news
            $projectNews->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
