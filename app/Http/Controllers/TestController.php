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
        $chatroomIds = auth()->user()->chatrooms->pluck('id');

        return Chatroom::with('subscribers', 'chats')->whereIn('id', $chatroomIds)->get();
    }
}
