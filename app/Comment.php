<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
