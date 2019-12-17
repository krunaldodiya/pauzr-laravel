<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Feed;
use App\Group;
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
        $id = "44a72c13-9f23-4481-bea7-71bbbd05d93a";

        $group = Group::where('id', $id)->first();

        $group->subscribers()->attach(['fb75dab8-e2ee-46e3-93e2-c81b3f8569a1']);
    }

    public function env(Request $request)
    {
        dd(env('APP_ENV'));
    }

    public function broadcast(Request $request)
    {
        return 'broadcasting';
    }
}
