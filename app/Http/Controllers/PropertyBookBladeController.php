<?php

namespace App\Http\Controllers;

use App\Application\DTO\PropertyBookDTO\PropertyBookDTO;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use App\Http\Requests\PropertyBook\CreatePropertyBookRequest;
use App\Http\Requests\PropertyBook\UpdatePropertyBookRequest;
use Illuminate\Http\Request;

class PropertyBookBladeController extends Controller
{
    protected $propertyBookService;

    public function __construct(PropertyBookServiceInterface $propertyBookService)
    {
        $this->propertyBookService = $propertyBookService;
    }

    public function index($projectId)
    {
        return $this->propertyBookService->paginate($projectId);
    }

    public function getAll($projectId)
    {
        return $this->propertyBookService->getAll($projectId);
    }

    public function show($id)
    {
        return $this->propertyBookService->show($id);
    }

 
}
