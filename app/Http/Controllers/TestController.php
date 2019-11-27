<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Notifications\UserFollowed;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{
    public function api(Request $request)
    {
        return User::with('followers', 'followings', 'country')
            ->where(function ($query) {
                return $query
                    ->where('name', 'LIKE', "%$krunal%")
                    ->orWhere('username', 'LIKE', "%$krunal%");
            })
            ->paginate();
    }

    public function web(Request $request)
    {
        $user = auth()->user();
        $following = User::find("fb75dab8-e2ee-46e3-93e2-c81b3f8569a1");

        Notification::send($following, new UserFollowed($following->toArray(), $user->toArray()));
    }

    public function env(Request $request)
    {
        dd(env('APP_ENV'));
    }

    public function broadcast(Request $request)
    {
        broadcast(new TestEvent('hello'));

        return 'hello';
    }
}
