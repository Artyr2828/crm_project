<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
  public function __invoke(){
      $stats = [
          'last_24h'   => Ticket::inPeriod('day')->count(),
          'last_week'  => Ticket::inPeriod('week')->count(),
          'last_month' => Ticket::inPeriod('month')->count(),
          'total'      => Ticket::count(),
      ];

      return new TicketStatisticsResource($stats);
  }
}
