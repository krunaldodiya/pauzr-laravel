<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function getPhotoAttribute($photo)
    {
        return $photo == null ? "default.jpeg" : $photo;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'group_subscribers');
    }
}
