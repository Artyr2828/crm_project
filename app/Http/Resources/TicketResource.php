<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'subject' => $this->subject,
                'status' => $this->status,
                'customer' => [
                    'name' => $this->customer->name,
                    'email' => $this->customer->email,
                ],
                
                'created_at' => $this->created_at->format('d.m.Y H:i'),
            ]
        ];
    }
}
