<?php

namespace App\Http\Controllers\View;

use App\Domain\Services\Contracts\PropertyBookBillServiceInterface;
use App\Http\Controllers\Controller;

class PropertyBookBillBladeController extends Controller
{
    protected $propertyBookBillService;

    public function __construct(PropertyBookBillServiceInterface $propertyBookBillService)
    {
        $this->propertyBookBillService = $propertyBookBillService;
    }

    public function index($propertyBookId)
    {
        return $this->propertyBookBillService->paginate($propertyBookId);
    }

    public function getAll($propertyBookId)
    {
        return $this->propertyBookBillService->getAll($propertyBookId);
    }

    public function show($id)
    {
        return $this->propertyBookBillService->show($id);
    }


}
