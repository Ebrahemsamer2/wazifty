<?php

use Illuminate\Database\Seeder;

use App\Job;
use App\Application;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $users = factory(App\User::class, 15)
           ->create()
           ->each(function ($user) {
                $user->userprofile()->save(factory(App\UserProfile::class)->make());
            });

    	// $users = factory('App\User', 15)->create();
    	
        $companies = factory(App\User::class, 15)
           ->create()
           ->each(function ($company) {
                $company->companyprofile()->save(factory(App\CompanyProfile::class)->make());
            });

    	factory('App\Category', 10)->create();
    	factory('App\Job', 50)->create();

    	factory('App\Resume', 4)->create();
    	$applications = factory('App\Application', 50)->create();

        // fill pivot table
        
        foreach ($users as $user) {
            
            $applications_ids = [];

            $application_id1 = Application::all()->random()->id;
            $applications_ids[] = $application_id1;
            $application_id2 = Application::all()->random()->id;

            if($application_id1 != $application_id2) {
                $applications_ids[] = $application_id2;
            }else {
                $application_id2 = Application::all()->random()->id;
                $applications_ids[] = $application_id2;
            }
            $user->applications()->sync($applications_ids);
        }

    	factory('App\Question', 10)->create();
    	factory('App\Answer', 5)->create();
        factory('App\Picture', 5)->create();

    }
}
