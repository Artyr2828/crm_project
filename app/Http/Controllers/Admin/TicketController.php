<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\AdminAndManager\TicketService;
use App\Http\Requests\Admin\TicketFilterRequest;
use App\Http\Requests\Admin\UpdateTicketStatusRequest;
//для мэнеджера или админа

class TicketController extends Controller
{
    //Здесь показ всех тикетов
    public function index(TicketFilterRequest $r, TicketService $service){
       $tickets = $service->getFilteredPaginated($r->validated());
       $stats = $service->getStats();
       return view('admin.tickets.index', compact('tickets', 'stats'));
    }

   //обновления статуса
    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket, TicketService $service)
{
    $service->updateStatus($ticket, $request->validated()['status']);
    return back()->with('success', 'Статус заявки успешно изменен!');
}


//простотр конкретной задачи
    public function show(Ticket $ticket)
{
    // Здесь солид я думаю не нужен так всего 2 строчки
    $ticket->load(['customer', 'media']);

    return view('admin.tickets.show', compact('ticket'));
}

}
