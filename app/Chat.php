<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }

    public function sender()
    {
        return $this->hasOne(User::class);
    }
}
