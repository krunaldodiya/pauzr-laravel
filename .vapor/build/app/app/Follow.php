<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function follower_user()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function following_user()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
