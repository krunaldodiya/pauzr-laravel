<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddBonusPoint
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $points = config('points.user_registered');

        $transaction = $user->createTransaction($points['points'], 'deposit', [
            'id' => $user->id,
            'type' => $points['type']
        ]);

        $user->deposit($transaction->transaction_id);
    }
}
