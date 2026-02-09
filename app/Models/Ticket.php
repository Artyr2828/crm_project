<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Carbon;

class Ticket extends Model implements HasMedia
{
  use InteractsWithMedia;
  protected $fillable = ['name', 'status', 'customer_id', 'subject', 'message'];

  public function scopeInPeriod($query, $period)
 {
     return $query->where('created_at', '>=', match($period) {
         'day'   => Carbon::now()->subDay(),
         'week'  => Carbon::now()->subWeek(),
         'month' => Carbon::now()->subMonth(),
         default => Carbon::now()->subYear(),
     });
 }

  public function customer(): BelongsTo{
    return $this->belongsTo(Customer::class);
  }

  public function scopeByStatus($query, $status){
    return $query->when($status, function ($q){
      $q->where('status', $status);
    });
  }
  public function scopeByData($query, $data){
    return $query->when($data, function ($q){
      $q->where('created_at', $data);
    });
  }

  public function scopeByEmail($query, $email)
{
    return $query->when($email, function ($q) use ($email) {
        return $q->whereHas('customer', function($q) use ($email) {
            $q->where('email', 'like', "%$email%");
        });
    });
}

public function scopeByPhone($query, $phone)
{
  return $query->when($phone, function ($q) use ($phone) {
      return $q->whereHas('customer', function ($q) use ($phone) {
          $q->where('phone', 'like', "%$phone%");
      });
  });
}

}
