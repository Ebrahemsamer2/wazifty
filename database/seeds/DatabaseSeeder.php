<?php

use Illuminate\Database\Seeder;

use App\Job;
use App\Application;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $users = factory(App\User::class, 30)
           ->create()
           ->each(function ($user) {
            if($user->emp_type == "employee") {
                $user->userprofile()->save(factory(App\UserProfile::class)->make());
            }else {
                $user->companyprofile()->save(factory(App\CompanyProfile::class)->make());
            }
            });
    	
        // $companies = factory(App\User::class, 15)
        //    ->create()
        //    ->each(function ($company) {
        //         $company->companyprofile()->save(factory(App\CompanyProfile::class)->make());
        //     });

    	factory('App\Category', 10)->create();
    	factory('App\Job', 50)->create();

    	factory('App\Resume', 4)->create();
    	$applications = factory('App\Application', 50)->create();

        // fill pivot table
        
        foreach ($users as $user) {
            if($user->emp_type == "employee") {
                $applications_ids = [];

                $application1 = Application::all()->random();
                $application_id1 = $application1->id;
                if(count($application1->questions) == 0){
                    $applications_ids[] = $application_id1;
                }
                $application2 = Application::all()->random();
                $application_id2 = $application2->id;
                if(count($application2->questions) == 0){
                    $applications_ids[] = $application_id2;
                }

                if($application_id1 != $application_id2) {
                    $applications_ids[] = $application_id2;
                }else {
                    $application2 = Application::all()->random();
                    $application_id2 = $application2->id;
                    $applications_ids[] = $application_id2;
                }
                $user->applications()->sync($applications_ids);
            }
        }

    	factory('App\Question', 10)->create();
        factory('App\Picture', 5)->create();

    }
}
