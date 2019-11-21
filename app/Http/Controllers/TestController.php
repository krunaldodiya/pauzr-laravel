<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $category = Category::first();

        $storage = Storage::disk('public')->url($category->background_image);

        dd($category->toArray());
    }
}
