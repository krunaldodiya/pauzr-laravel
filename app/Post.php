<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $appends = ['when', 'is_favorited'];

    public function getIsFavoritedAttribute()
    {
        return !!auth()->user()->favorites->where('id', $this->id)->count();
    }

    public function getWhenAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
