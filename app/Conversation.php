<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable=['userId', 'destId', 'hasUnread', 'lastActivity'];

     public function destUser()
    {
        return $this->hasOne('App\User', 'id', 'destId');
    }
}
