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
        TestEvent::broadcast("hello");

        return 'done';
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
