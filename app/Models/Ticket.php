<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Ticket extends Model
{
  protected $fillable = ['name', 'email', 'phone'];

   
   public function tickets(): HasMany
   {
       return $this->hasMany(Ticket::class);
   }
}
