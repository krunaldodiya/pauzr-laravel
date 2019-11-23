<?php

namespace App\Http\Controllers;

use App\Chatroom;
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
        return User::with('followers', 'followings', 'country')
            ->where('id', '43e2634d-d284-44fb-b01e-04a805b9fb47')->first();
    }
}
