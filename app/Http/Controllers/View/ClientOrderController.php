<?php

namespace App\Http\Controllers\View;

use App\Application\DTO\PropertyUnitOrderDTO\PropertyUnitOrderDTO;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyUnitOrder\CreatePropertyUnitOrderRequest;
use Illuminate\Http\Request;

class ClientOrderController extends Controller
{
    private $propertyUnitOrderService ;
    public function __construct(PropertyUnitOrderServiceInterface $propertyUnitOrderService)
    {
        $this->propertyUnitOrderService = $propertyUnitOrderService;
    }
    public function create(CreatePropertyUnitOrderRequest $request)
    {
            $data = PropertyUnitOrderDTO::fromCreateRequest($request->validated());
            $order = $this->propertyUnitOrderService->create($data);

            if(!$order) {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
            return redirect()->back()->with('success', 'Order Registered successfully.');
    }
    public function myOrders()
    {
        // Assuming logged-in client is authenticated via `auth('client')`
        $clientId = auth('client')->id();

        $orders = $this->propertyUnitOrderService->getClientOrders($clientId);

        return view('pages.clientOrders.my-orders', compact('orders'));
    }
}
