<?php

namespace App\Http\Controllers;

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
        $user = auth()->user();

        // $transaction = $user->createTransaction(100, 'deposit', ['description' => 'transaction description']);
        // $user->deposit($transaction->transaction_id);

        return ['data' => $user->transactions];
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
