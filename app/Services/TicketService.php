<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Customer;

class TicketService
{
    //отправить тикет(Post)
    public function store(array $data){
     $customer = Customer::firstOrCreate(
         ['email' => $data['email']],
         ['name' => $data['name'], 'phone' => $data['phone']]
       );

       //по связи кастомеру делаем тикет
       $ticket = $customer->tickets()->create([
        'subject' => $data['subject'],
        'message' => $data['message'],
        'status'  => 'new',
      ]);

      if (isset($data['file'])) {
        $ticket->addMedia($data['file'])->toMediaCollection('attachments');
    }
  return $ticket->load('customer');
    }
}
