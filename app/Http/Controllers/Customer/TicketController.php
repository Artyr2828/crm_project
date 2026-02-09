<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Services\Customer\TicketService;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
   //отправляем задачу
    public function store(StoreTicketRequest $r, TicketService $ticketService){
        $ticket = $ticketService->store($r->validated());
        return new TicketResource($ticket);
    }
}
