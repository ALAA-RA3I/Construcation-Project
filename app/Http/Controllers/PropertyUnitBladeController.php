<?php

namespace App\Http\Controllers;

use App\Application\DTO\PropertyUnitDTO\PropertyUnitDTO;
use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use App\Http\Requests\PropertyUnit\CreatePropertyUnitRequest;
use App\Http\Requests\PropertyUnit\UpdatePropertyUnitRequest;
use Illuminate\Http\Request;

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
