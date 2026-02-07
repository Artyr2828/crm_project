<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Services\TicketService;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
   //отправляем задачу
    public function store(StoreTicketRequest $r, TicketService $ticketService){
        $ticket = $ticketService->store($r->validated());
        return new TicketResource($ticket);
    }
}
