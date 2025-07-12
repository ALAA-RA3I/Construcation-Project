<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectSalesDetailsRepositoryInterface;
use App\Domain\Services\Contracts\ProjectSalesDetailsServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectSalesDetailsService implements ProjectSalesDetailsServiceInterface
{
    use HasFileHandler;
    protected $projectSalesDetailsRepo;

    public function __construct(ProjectSalesDetailsRepositoryInterface $projectSalesDetailsRepo)
    {
        $this->projectSalesDetailsRepo = $projectSalesDetailsRepo;
    }

    public function getAll()
    {
        $this->projectSalesDetailsRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->projectSalesDetailsRepo->all();
    }

    public function paginate()
    {
        $this->projectSalesDetailsRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->projectSalesDetailsRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Handle main_image file upload
            if (isset($data['main_image']) && $data['main_image'] instanceof \Illuminate\Http\UploadedFile) {
                $mainImagePath = $this->storeFile($data['main_image'], 'project-sales-details', 'public');
                if (!$mainImagePath) {
                    Log::error("Main image storage failed.");
                    DB::rollBack();
                    return false;
                }
                $data['main_image'] = $mainImagePath;
            }

            // Handle diagram_image file upload
            if (isset($data['diagram_image']) && $data['diagram_image'] instanceof \Illuminate\Http\UploadedFile) {
                $diagramImagePath = $this->storeFile($data['diagram_image'], 'project-sales-details', 'public');
                if (!$diagramImagePath) {
                    Log::error("Diagram image storage failed.");
                    DB::rollBack();
                    return false;
                }
                $data['diagram_image'] = $diagramImagePath;
            }

            // Handle video_url file upload
            if (isset($data['video_url']) && $data['video_url'] instanceof \Illuminate\Http\UploadedFile) {
                $videoPath = $this->storeFile($data['video_url'], 'project-sales-details/videos', 'public');
                if (!$videoPath) {
                    Log::error("Video storage failed.");
                    DB::rollBack();
                    return false;
                }
                $data['video_url'] = $videoPath;
            }

            $projectSalesDetails = $this->projectSalesDetailsRepo->create($data);
            DB::commit();
            return $projectSalesDetails->load(['project']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $projectSalesDetails = $this->projectSalesDetailsRepo->pushCriteria(new WithRelationsCriteria(['project']))->find($id);
        return $projectSalesDetails;
    }

    public function update($id, array $data)
    {
        try {
            $projectSalesDetails = $this->projectSalesDetailsRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project Sales Details not found');
        }

        // Handle main_image file upload
        if (isset($data['main_image']) && $data['main_image'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old file if exists
            if ($projectSalesDetails->main_image && $this->fileExists($projectSalesDetails->main_image)) {
                $this->deleteFile($projectSalesDetails->main_image);
            }

            $mainImagePath = $this->storeFile($data['main_image'], 'project-sales-details', 'public');
            if (!$mainImagePath) {
                Log::error("Main image storage failed during update.");
                return false;
            }
            $data['main_image'] = $mainImagePath;
        }

        // Handle diagram_image file upload
        if (isset($data['diagram_image']) && $data['diagram_image'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old file if exists
            if ($projectSalesDetails->diagram_image && $this->fileExists($projectSalesDetails->diagram_image)) {
                $this->deleteFile($projectSalesDetails->diagram_image);
            }

            $diagramImagePath = $this->storeFile($data['diagram_image'], 'project-sales-details', 'public');
            if (!$diagramImagePath) {
                Log::error("Diagram image storage failed during update.");
                return false;
            }
            $data['diagram_image'] = $diagramImagePath;
        }

        // Handle video_url file upload
        if (isset($data['video_url']) && $data['video_url'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old file if exists
            if ($projectSalesDetails->video_url && $this->fileExists($projectSalesDetails->video_url)) {
                $this->deleteFile($projectSalesDetails->video_url);
            }

            $videoPath = $this->storeFile($data['video_url'], 'project-sales-details/videos', 'public');
            if (!$videoPath) {
                Log::error("Video storage failed during update.");
                return false;
            }
            $data['video_url'] = $videoPath;
        }

        $this->projectSalesDetailsRepo->update($data, $id);
        return $projectSalesDetails->fresh()->load(['project']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $projectSalesDetails = $this->projectSalesDetailsRepo->find($id);

            if (!$projectSalesDetails) {
                return false;
            }

            // Delete associated files
            if ($projectSalesDetails->main_image && $this->fileExists($projectSalesDetails->main_image)) {
                $this->deleteFile($projectSalesDetails->main_image);
            }

            if ($projectSalesDetails->diagram_image && $this->fileExists($projectSalesDetails->diagram_image)) {
                $this->deleteFile($projectSalesDetails->diagram_image);
            }

            if ($projectSalesDetails->video_url && $this->fileExists($projectSalesDetails->video_url)) {
                $this->deleteFile($projectSalesDetails->video_url);
            }

            // Soft delete the project sales details
            $projectSalesDetails->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
