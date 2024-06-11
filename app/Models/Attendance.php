<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }
    // public function users()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function userEvents()
    {
        return $this->belongsTo(UserEvent::class,'user_id');
    }
}
