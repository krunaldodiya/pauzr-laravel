<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Invitation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckInvitation
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
        $points = config('points.user_registered');

        $receiver = $event->user;

        $invitation = Invitation::with('sender')
            ->where(['mobile_cc' => $receiver['mobile_cc']])
            ->count();

        if ($invitation) {
            collect([$receiver, $invitation->sender])->foreach(function ($user) use ($points) {
                $transaction = $user->createTransaction($points['invitation'], 'deposit', [
                    'points' => [
                        'id' => $user->id,
                        'type' => $points['type']
                    ]
                ]);

                $user->deposit($transaction->transaction_id);
            });
        }
    }
}
