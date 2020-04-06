<?php

namespace App\Models\Entities;

use App\Models\Entities\EventDate;
use Illuminate\Database\Eloquent\Model;

class EventTime extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 
    'event_date_id',
    'slot_start',
    'slot_end',
    'is_scheduled'
  ];

  public function users() {
      return $this->belongsToMany(User::class);
  }
  
  public function eventDates()
  {
      return $this->hasMany(EventDate::class);
  }
}
