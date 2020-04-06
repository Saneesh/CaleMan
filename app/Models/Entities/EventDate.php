<?php

namespace App\Models\Entities;

use App\Models\Entities\EventTime;
use App\Models\Entities\User;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 
    'event_date'
  ];

  public function users() {
    return $this->belongsToMany(User::class);
  }
    
  public function eventTimes()
  {
    return $this->hasMany(EventTime::class);
  }
}
