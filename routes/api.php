<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\TicketController;
use App\Http\Controllers\StatisticsController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//отправка тикета
Route::post('/tickets', [TicketController::class, 'store']);

Route::get('/tickets/statistics', StatisticsController::class);

Route::get('tickets', [\App\Http\Controllers\Admin\TicketController::class, 'index']);
