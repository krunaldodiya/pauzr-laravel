<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUuid;

    public $timestamps = false;

    public $incrementing = false;

    protected $guarded = [];
}
