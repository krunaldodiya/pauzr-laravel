<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function getInitialScreenAttribute($initial_screen)
    {
        $auth = auth()->user();

        return $auth ? $initial_screen : "Auth";
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
