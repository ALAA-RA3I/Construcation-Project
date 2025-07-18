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

    public function index()
    {
        return $this->propertyBookBillService->paginate();
    }

    public function getAll()
    {
        return $this->propertyBookBillService->getAll();
    }

    public function show($id)
    {
        return $this->propertyBookBillService->show($id);
    }

   
}
