<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'chatroom_subscribers');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
