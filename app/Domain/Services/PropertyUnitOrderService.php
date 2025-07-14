<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\PropertyUnitOrderRepositoryInterface;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Traits\HasFileHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertyUnitOrderService implements PropertyUnitOrderServiceInterface
{
    use HasFileHandler;
    protected $propertyUnitOrderRepo;

    public function __construct(PropertyUnitOrderRepositoryInterface $propertyUnitOrderRepo)
    {
        $this->propertyUnitOrderRepo = $propertyUnitOrderRepo;
    }

    public function getAll()
    {
        $this->propertyUnitOrderRepo->pushCriteria(new WithRelationsCriteria(['propertyUnit']));
        return $this->propertyUnitOrderRepo->all();
    }

    public function paginate()
    {
        $this->propertyUnitOrderRepo->pushCriteria(new WithRelationsCriteria(['propertyUnit']));
        return $this->propertyUnitOrderRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Handle identity_file upload
            if (isset($data['identity_file']) && $data['identity_file'] instanceof \Illuminate\Http\UploadedFile) {
                $identityPath = $this->storeFile($data['identity_file'], 'property-unit-orders/identity', 'public');
                if (!$identityPath) {
                    Log::error("Identity file storage failed.");
                    DB::rollBack();
                    return false;
                }
                $data['identity_file'] = $identityPath;
            }
            // Handle clearance_certificate upload
            if (isset($data['clearance_certificate']) && $data['clearance_certificate'] instanceof \Illuminate\Http\UploadedFile) {
                $clearancePath = $this->storeFile($data['clearance_certificate'], 'property-unit-orders/clearance', 'public');
                if (!$clearancePath) {
                    Log::error("Clearance certificate storage failed.");
                    DB::rollBack();
                    return false;
                }
                $data['clearance_certificate'] = $clearancePath;
            }

            $order = $this->propertyUnitOrderRepo->create($data);
            DB::commit();
            return $order->load(['propertyUnit']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $order = $this->propertyUnitOrderRepo->pushCriteria(new WithRelationsCriteria(['propertyUnit']))->find($id);
        return $order;
    }

    public function update($id, array $data)
    {
        try {
            $order = $this->propertyUnitOrderRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Property Unit Order not found');
        }
        // Handle identity_file upload
        if (isset($data['identity_file']) && $data['identity_file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($order->identity_file && $this->fileExists($order->identity_file)) {
                $this->deleteFile($order->identity_file);
            }
            $identityPath = $this->storeFile($data['identity_file'], 'property-unit-orders/identity', 'public');
            if (!$identityPath) {
                Log::error("Identity file storage failed during update.");
                return false;
            }
            $data['identity_file'] = $identityPath;
        }
        // Handle clearance_certificate upload
        if (isset($data['clearance_certificate']) && $data['clearance_certificate'] instanceof \Illuminate\Http\UploadedFile) {
            if ($order->clearance_certificate && $this->fileExists($order->clearance_certificate)) {
                $this->deleteFile($order->clearance_certificate);
            }
            $clearancePath = $this->storeFile($data['clearance_certificate'], 'property-unit-orders/clearance', 'public');
            if (!$clearancePath) {
                Log::error("Clearance certificate storage failed during update.");
                return false;
            }
            $data['clearance_certificate'] = $clearancePath;
        }
        $this->propertyUnitOrderRepo->update($data, $id);
        return $order->fresh()->load(['propertyUnit']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->propertyUnitOrderRepo->find($id);
            if (!$order) {
                return false;
            }
            if ($order->identity_file && $this->fileExists($order->identity_file)) {
                $this->deleteFile($order->identity_file);
            }
            if ($order->clearance_certificate && $this->fileExists($order->clearance_certificate)) {
                $this->deleteFile($order->clearance_certificate);
            }
            $order->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
