<?php

namespace App\Domain\Services;

use App\Criteria\WhereCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Domain\Enums\PropertUnitOrderStatusEnum;
use App\Infrastructure\Repositories\Contracts\PropertyUnitOrderRepositoryInterface;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Models\PropertyUnitOrder;
use App\Traits\HasFileHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\Auth;
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
        $this->propertyUnitOrderRepo->pushCriteria(new WithRelationsCriteria(['propertyUnit', 'client']));
        return $this->propertyUnitOrderRepo->all();
    }

    public function paginate()
    {
        $this->propertyUnitOrderRepo->pushCriteria(new WithRelationsCriteria(['propertyUnit', 'client']));
        return $this->propertyUnitOrderRepo->paginate();
    }

    public function create(array $data)
{
    DB::beginTransaction();
    try {

        $data['priority_number'] = $this->generatePriorityNumber($data['property_book_id']);

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

        $order = $this->propertyUnitOrderRepo->create($data);
        DB::commit();
        return $order->load(['propertyBook', 'client']);
    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
}

    public function show($id)
    {
        $order = $this->propertyUnitOrderRepo->pushCriteria(new WithRelationsCriteria(['propertyBook', 'client']))->find($id);
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
        $this->propertyUnitOrderRepo->update($data, $id);
        return $order->fresh()->load(['propertyUnit', 'client']);
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
    private function generatePriorityNumber(int $propertyBookId): int
    {
        // Get the maximum priority number for this property book
        $maxPriority = PropertyUnitOrder::where('property_book_id', $propertyBookId)
            ->max('priority_number');

        // If no orders exist for this book yet, start from 1000
        if (is_null($maxPriority)) {
            return 1000;
        }

        // Increment by 1 from the current max
        return $maxPriority + 1;
    }
    public function getClientOrders($clientId)
    {
        return $this->propertyUnitOrderRepo
            ->join('property_books', 'property_unit_orders.property_book_id', '=', 'property_books.id')
            ->join('projects', 'property_books.project_id', '=', 'projects.id')
            ->join('project_sales_details', 'projects.id', '=', 'project_sales_details.project_id')
            ->where('property_unit_orders.client_id', $clientId)
            ->select(
                'property_books.id',
                'property_unit_orders.priority_number',
                'property_unit_orders.status',
                'property_books.price',
                'property_books.first_payment_amount',
                'project_sales_details.main_title',
                'project_sales_details.address'
            )
            ->paginate();
    }
}
