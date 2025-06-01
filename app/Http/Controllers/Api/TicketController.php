<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\TicketDTO\TicketDTO;
use App\Domain\Services\Contracts\TicketServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketServiceInterface $ticketService)
    {   
        $this->ticketService = $ticketService;
    }

    public function index() {
        $tickets = $this->ticketService->paginate();
        return ApiResponse::success(TicketResource::collection($tickets));
    }

    public function getAll() {
        $tickets = $this->ticketService->getAll();
        return ApiResponse::success(TicketResource::collection($tickets));
    }

    public function show($id) {
        $ticket = $this->ticketService->show($id);
        if (!$ticket) 
            return ApiResponse::error('Ticket not found', 404);
        return ApiResponse::success(new TicketResource($ticket));
    }

    public function create(CreateTicketRequest $request) {
        $validatedData = TicketDTO::fromCreateRequest($request->validated());
        $ticket = $this->ticketService->create($validatedData);
        if (!$ticket) 
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new TicketResource($ticket), 'Ticket created successfully');
    }

    public function update(UpdateTicketRequest $request, $id) {
        $validatedData = TicketDTO::fromUpdateRequest($request->validated());
        $ticket = $this->ticketService->update($id, $validatedData);
        if (!$ticket) 
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new TicketResource($ticket), 'Ticket updated successfully');
    }

    public function delete($id) {
        $deleted = $this->ticketService->delete($id);

        if(!$deleted)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(null, 'Ticket deleted successfully');
    }
}