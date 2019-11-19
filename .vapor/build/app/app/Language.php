<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];
}
