<?php

namespace App\Listeners;

use App\Events\EmployeeContact;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Illuminate\Support\Facades\DB;

class EmployeeContactListener
{

    public function __construct()
    {
        //
    }

    public function handle(EmployeeContact $event)
    {
        $user = $event->user;
        $company_id = $event->company_id;

        $company = User::where('id', $company_id)->first();
        foreach ($company->jobs as $job) {
            if($user->applications()->where('application_id', $job->application->id)) {
                DB::table('application_user')->where('user_id', $user->id)->where('application_id', $job->application->id)->update([
                    'contact' => 1,
                ]);
            }
        }
    }
}
