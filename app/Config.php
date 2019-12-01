<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
