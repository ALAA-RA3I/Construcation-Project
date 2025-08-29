<?php

namespace App\Domain\Services;

use App\Criteria\WhereCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\PropertyBookRepositoryInterface;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertyBookService implements PropertyBookServiceInterface
{
    use HasFileHandler;
    protected $propertyBookRepo;

    public function __construct(PropertyBookRepositoryInterface $propertyBookRepo)
    {
        $this->propertyBookRepo = $propertyBookRepo;
    }

    public function getAll($projectId)
    {
        $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria(['project']));


        $this->propertyBookRepo->pushCriteria(new \App\Criteria\ProjectCriteria($projectId));


        return $this->propertyBookRepo->all();
    }

    public function paginate($projectId)
    {
//        $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria(['project']));
        $this->propertyBookRepo->pushCriteria(new \App\Criteria\ProjectCriteria($projectId));

        return $this->propertyBookRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Handle diagram_image file upload
            if (isset($data['diagram_image']) && $data['diagram_image'] instanceof \Illuminate\Http\UploadedFile) {
                $diagramImagePath = $this->storeFile($data['diagram_image'], 'property-books', 'public');
                if (!$diagramImagePath) {
                    Log::error("Diagram image storage failed.");
                    DB::rollBack();
                    return false;
                }
                $data['diagram_image'] = $diagramImagePath;
            }

            $propertyBook = $this->propertyBookRepo->create($data);
            DB::commit();
            return $propertyBook->load(['project']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $propertyBook = $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria(['bills']))->find($id);
        return $propertyBook;
    }

    public function update($id, array $data)
    {
        try {
            $propertyBook = $this->propertyBookRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Property Book not found');
        }

        // Handle diagram_image file upload
        if (isset($data['diagram_image']) && $data['diagram_image'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old file if exists
            if ($propertyBook->diagram_image && $this->fileExists($propertyBook->diagram_image)) {
                $this->deleteFile($propertyBook->diagram_image);
            }

            $diagramImagePath = $this->storeFile($data['diagram_image'], 'property-books', 'public');
            if (!$diagramImagePath) {
                Log::error("Diagram image storage failed during update.");
                return false;
            }
            $data['diagram_image'] = $diagramImagePath;
        }

        $this->propertyBookRepo->update($data, $id);
        return $propertyBook->fresh()->load(['project']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $propertyBook = $this->propertyBookRepo->find($id);

            if (!$propertyBook) {
                return false;
            }

            // Delete associated files
            if ($propertyBook->diagram_image && $this->fileExists($propertyBook->diagram_image)) {
                $this->deleteFile($propertyBook->diagram_image);
            }

            // Soft delete the property book
            $propertyBook->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function getPropertyUnits($bookId)
    {
        $this->propertyBookRepo->pushCriteria(new WhereCriteria('id', $bookId));
        $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria([
            'propertyUnits.client'
        ]));

        $book = $this->propertyBookRepo->first();

        return $book ? $book->propertyUnits : collect([]);
    }
}
