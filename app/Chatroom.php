<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $appends = [
        'chatroom_image'
    ];

    public function getChatroomImageAttribute($chatroom_image)
    {
        return $chatroom_image == null
            ? "https://images.vexels.com/media/users/3/139911/isolated/preview/1afb4038427b2bd8edd275940aea269d-chat-service-icon-by-vexels.png"
            : $chatroom_image;
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'chatroom_subscribers');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
