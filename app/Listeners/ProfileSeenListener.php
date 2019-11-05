<?php

namespace App\Listeners;

use App\Events\ProfileSeen;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\DB;
use App\User;

class ProfileSeenListener
{


    public function __construct()
    {
        //
    }

    public function handle(ProfileSeen $event)
    {

        $user = $event->user;
        $company_id = $event->company_id;

        $company = User::where('id', $company_id)->first();
        foreach ($company->jobs as $job) {
            if($user->applications()->where('application_id', $job->application->id)) {
                DB::table('application_user')->where('user_id', $user->id)->where('application_id', $job->application->id)->update([
                    'seen' => 1,
                ]);
            }
        }
    }
}
