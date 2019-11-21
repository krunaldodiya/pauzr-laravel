<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasUuid;

    public $timestamps = false;

    public $incrementing = false;

    protected $guarded = [];

    public function getBackgroundImageAttribute($image)
    {
        return Storage::disk('public')->url($image);
    }
}
