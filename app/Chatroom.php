<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class GroupChatroom extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'chat_subscribers');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
