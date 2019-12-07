<?php

namespace App\Http\Controllers;

use App\Comment;
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
        return Comment::with('replies')->where('post_id', "b72dc7c6-490c-474d-8a74-fb6bd5f37ac3")->get();
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
