<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Bag;

class AuthLogin
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

    public function handle($event)
    {
        $bags = Bag::where('user_id', $event->user->id)->whereNull('send_at')->where('end_at', '>', date('Y-m-d H:i:s'))->get();
        foreach ($bags as $bag) {
            $bag->updateEnd();
            $bag->first_reminder_at = null;
            $bag->second_reminder_at = null;
            $bag->save();
        }
    }
}
