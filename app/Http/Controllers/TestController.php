<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\User;

use Illuminate\Http\Request;

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
        try {
            event(new TestEvent('test'));
            return env('BROADCAST_DRIVER');
        } catch (\Throwable $th) {
            dump($th);
        }
    }
}
