<?php

namespace App\Http\Controllers\View;

use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use App\Http\Controllers\Controller;

class PropertyUnitBladeController extends Controller
{
    protected $propertyUnitService;

    public function __construct(PropertyUnitServiceInterface $propertyUnitService)
    {
        $this->propertyUnitService = $propertyUnitService;
    }

    public function index($propertyBookId)
    {
        return $this->propertyUnitService->paginate($propertyBookId);
    }

    public function getAll($propertyBookId)
    {
        return $this->propertyUnitService->getAll($propertyBookId);
    }

    public function show($id)
    {
        return $this->propertyUnitService->show($id);
    }
}
