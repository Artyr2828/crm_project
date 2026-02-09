<?php
namespace App\Services\AdminAndManager;
use App\Models\Ticket;
//здесь если логики много то можно впринципе также логику вынести чтобы сервис чистым был
class TicketService{
  public function getFilteredPaginated(array $filters){
    return Ticket::with('customer')
    ->byStatus($filters['status'] ?? null)
    ->byEmail($filters['email'] ?? null)
    ->byPhone($filters['phone'] ?? null)
     ->latest()
     ->paginate(10);
  }

  public function updateStatus(Ticket $ticket, string $status): bool{
    return $ticket->update(['status' => $status]);
  }


  public function getStats(): array{
    return [
        'last_24h'   => Ticket::where('created_at', '>=', now()->subDay())->count(),
        'last_week'  => Ticket::where('created_at', '>=', now()->subWeek())->count(),
        'last_month' => Ticket::where('created_at', '>=', now()->subMonth())->count(),
        'total'      => Ticket::count(),
    ];
  }
}
