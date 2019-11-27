<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function attachable()
    {
        return $this->morphTo();
    }
}
