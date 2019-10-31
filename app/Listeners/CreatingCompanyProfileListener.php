<?php

namespace App\Listeners;

use App\Events\CreatingCompanyProfile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\CompanyProfile;

class CreatingCompanyProfileListener
{

    public function __construct()
    {
        //
    }

    public function handle(CreatingCompanyProfile $event)
    {
        CompanyProfile::create([
            'user_id' => $event->user->id,
        ]);
    }
}
