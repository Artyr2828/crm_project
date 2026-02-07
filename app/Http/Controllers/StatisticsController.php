<?php

namespace App\Http\Controllers;

// Заменили import на use
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'last_24h' => Ticket::inPeriod('day')->count(),
                'last_week' => Ticket::inPeriod('week')->count(),
                'last_month' => Ticket::inPeriod('month')->count(),
                'total' => Ticket::count(),
            ]
        ]);
    }
}
