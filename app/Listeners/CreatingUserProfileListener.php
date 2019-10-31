<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\CreatingUserProfile;
use App\UserProfile;

class CreatingUserProfileListener
{

    public function __construct()
    {
        //
    }

    public function handle(CreatingUserProfile $event)
    {
        UserProfile::create([
            'user_id' => $event->user->id,
        ]);
    }
}
