<?php

namespace App;

use App\Events\UserCreated;
use App\Traits\HasUuid;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasUuid;
    use Searchable;

    protected $fillable = [
        'fcm_token', 'name', 'email', 'email_verified_at', 'mobile', 'mobile_verified_at', 'username', 'password',
        'dob', 'gender', 'avatar', 'country_id', 'status', 'remember_token', 'bio', 'language', 'version'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'mobile_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    protected $appends = [
        'is_following', 'is_follower',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function searchableAs()
    {
        return 'name';
    }

    public function getIsFollowingAttribute()
    {
        return !!Follow::where(['follower_id' => auth()->id(), 'following_id' => $this->id])->count();
    }

    public function getIsFollowerAttribute()
    {
        return !!Follow::where(['following_id' => auth()->id(), 'follower_id' => $this->id])->count();
    }

    public function getAvatarAttribute($avatar)
    {
        return $avatar == null ? "https://huntpng.com/images250/default-avatar-png-11.png" : $avatar;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function generate_username($name, $rand_num = 1000)
    {
        $parts = array_slice(array_filter(explode(" ", strtolower($name))), 0, 2);

        $part1 = (!empty($parts[0])) ? substr($parts[0], 0, strlen($parts[0])) : "";
        $part2 = (!empty($parts[1])) ? substr($parts[1], 0, rand(0, strlen($parts[1]))) : "";

        $username = $part1 . $part2 . rand(0, $rand_num);
        $exists = self::where('username', $username)->first();

        if ($exists) {
            return self::generate_username($name, $rand_num = 200);
        } else {
            return $username;
        }
    }
}
