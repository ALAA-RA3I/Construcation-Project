<?php

namespace App\Http\Controllers;

use App\Application\DTO\PropertyBookBillDTO\PropertyBookBillDTO;
use App\Domain\Services\Contracts\PropertyBookBillServiceInterface;
use App\Http\Requests\PropertyBookBill\CreatePropertyBookBillRequest;
use App\Http\Requests\PropertyBookBill\UpdatePropertyBookBillRequest;
use Illuminate\Http\Request;

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
