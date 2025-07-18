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

    public function index()
    {
        return $this->propertyUnitService->paginate();
    }

    public function getAll()
    {
        return $this->propertyUnitService->getAll();
    }

    public function show($id)
    {
        return $this->propertyUnitService->show($id);
    }
}
