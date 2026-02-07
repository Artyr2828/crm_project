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
  protected $fillable = ['name', 'email', 'phone', 'status', 'customer_id', 'subject', 'message'];

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

  
}
