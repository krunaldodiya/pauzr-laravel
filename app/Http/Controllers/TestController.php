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
        $id = "cc70f08b-9744-4185-9289-9c71ce74bd62";

        Group::where('id', $id)
            ->update([
                'name' => "hello",
                'description' => "hello there",
            ]);

        return Group::where('id', $id)->first();
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
