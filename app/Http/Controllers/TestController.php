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
        $authUser = auth()->user();
        $friend_id = "fb75dab8-e2ee-46e3-93e2-c81b3f8569a1";

        $chatrooms = $authUser
            ->chatrooms()
            ->where(function ($query) use ($friend_id) {
                return $query
                    ->where('chatroom_type', "Private")
                    ->whereHas('subscribers', function ($query) use ($friend_id) {
                        return $query->where("id", $friend_id);
                    });
            })
            ->first();

        return $chatrooms;
    }
}
