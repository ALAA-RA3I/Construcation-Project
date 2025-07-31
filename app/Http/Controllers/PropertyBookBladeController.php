<?php

namespace App\Http\Controllers;

use App\Application\DTO\PropertyBookDTO\PropertyBookDTO;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use App\Http\Requests\PropertyBook\CreatePropertyBookRequest;
use App\Http\Requests\PropertyBook\UpdatePropertyBookRequest;
use App\Traits\HasFileHandler;
use Illuminate\Http\Request;

class PropertyBookBladeController extends Controller
{
    use HasFileHandler;
    protected $propertyBookService;

    public function __construct(PropertyBookServiceInterface $propertyBookService)
    {
        $this->propertyBookService = $propertyBookService;
    }

    public function index($projectId)
    {
        $books = $this->propertyBookService->paginate($projectId);
        // تعديل روابط الصور والفيديو هنا فقط
        $books->getCollection()->transform(function ($item) {
            $item->diagram_image = $item->diagram_image ? $this->getAssetFileUrl($item->diagram_image) : null;
            return $item;
        });

        return view('pages.salesSection.books-of-unit-page',compact('books'));
    }

    public function getAll($projectId)
    {
        return $this->propertyBookService->getAll($projectId);
    }

    public function show($id)
    {
        $book = $this->propertyBookService->show($id);
        // Process the diagram_image
        $book->diagram_image = $book->diagram_image ? $this->getAssetFileUrl($book->diagram_image) : null;
        return view('pages.salesSection.book-details-page', compact('book'));
    }


}
