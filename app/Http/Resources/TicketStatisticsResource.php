<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'last_24h'   => $this->resource['last_24h'],
          'last_week'  => $this->resource['last_week'],
          'last_month' => $this->resource['last_month'],
          'total'      => $this->resource['total'],
      ];
    }
}
