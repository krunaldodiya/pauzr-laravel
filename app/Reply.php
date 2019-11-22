<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
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
