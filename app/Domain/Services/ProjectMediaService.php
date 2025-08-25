<?php

namespace App\Domain\Services;

use App\Criteria\WhereCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectMediaRepositoryInterface;
use App\Domain\Services\Contracts\ProjectMediaServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectMediaService implements ProjectMediaServiceInterface
{
    use HasFileHandler;
    protected $projectMediaRepo;

    public function __construct(ProjectMediaRepositoryInterface $projectMediaRepo)
    {
        $this->projectMediaRepo = $projectMediaRepo;
    }

    public function getAll($projectId = null)
    {
        $this->projectMediaRepo->pushCriteria(new WithRelationsCriteria(['project']));
        if($projectId)
        {
            $this->projectMediaRepo->pushCriteria(new WhereCriteria('project_id',$projectId));
        }
        return $this->projectMediaRepo->all();
    }

    public function paginate($projectId = null)
    {
        $this->projectMediaRepo->pushCriteria(new WithRelationsCriteria(['project']));
        if($projectId)
        {
            $this->projectMediaRepo->pushCriteria(new WhereCriteria('project_id',$projectId));
        }
        return $this->projectMediaRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Handle path_file upload
            if (isset($data['path_file']) && $data['path_file'] instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $this->storeFile($data['path_file'], 'project-media', 'public');
                if (!$filePath) {
                    Log::error("File storage failed for project media.");
                    DB::rollBack();
                    return false;
                }
                $data['path_file'] = $filePath;
            }

            $projectMedia = $this->projectMediaRepo->create($data);
            DB::commit();
            return $projectMedia->load(['project']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $projectMedia = $this->projectMediaRepo->pushCriteria(new WithRelationsCriteria(['project']))->find($id);
        return $projectMedia;
    }

    public function update($id, array $data)
    {
        try {
            $projectMedia = $this->projectMediaRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project Media not found');
        }

        // Handle path_file upload
        if (isset($data['path_file']) && $data['path_file'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old file if exists
            if ($projectMedia->path_file && $this->fileExists($projectMedia->path_file)) {
                $this->deleteFile($projectMedia->path_file);
            }

            $filePath = $this->storeFile($data['path_file'], 'project-media', 'public');
            if (!$filePath) {
                Log::error("File storage failed during update for project media.");
                return false;
            }
            $data['path_file'] = $filePath;
        }

        $this->projectMediaRepo->update($data, $id);
        return $projectMedia->fresh()->load(['project']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $projectMedia = $this->projectMediaRepo->find($id);

            if (!$projectMedia) {
                return false;
            }

            // Delete associated file
            if ($projectMedia->path_file && $this->fileExists($projectMedia->path_file)) {
                $this->deleteFile($projectMedia->path_file);
            }

            // Soft delete the project media
            $projectMedia->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
