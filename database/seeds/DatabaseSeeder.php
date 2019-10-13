<?php

use Illuminate\Database\Seeder;

use App\Job;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$users = factory('App\User', 30)->create();
    	factory('App\User_Profile', 10)->create();
    	factory('App\Company_Profile', 5)->create();
    	factory('App\Category', 10)->create();
    	$jobs = factory('App\Job', 10)->create();

        // fill pivot table
        
    	foreach ($users as $user) {
            $jobs_ids = [];
            $id1 = Job::all()->random()->id;
            $jobs_ids[] = $id1;
            $id2 = Job::all()->random()->id;

            if($id1 != $id2) {
                $jobs_ids[] = $id2;
            }else {
                $id2 = Job::all()->random()->id;
                $jobs_ids[] = $id2;
            }
    		$user->jobs()->sync($jobs_ids);
    	}

    	factory('App\CV', 10)->create();
    	factory('App\Application', 5)->create();
    	factory('App\Question', 10)->create();
    	factory('App\Answer', 5)->create();
        factory('App\Picture', 5)->create();

    }
}
