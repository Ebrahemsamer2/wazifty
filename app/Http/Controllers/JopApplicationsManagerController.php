<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Job;

class JopApplicationsManagerController extends Controller
{
    public function __construct() {
    	return $this->middleware(['auth', 'onlycompany']);
    }

    public function jobApplications($id, $slug) {

    	if(auth()->user()->id == $id) {
    		$job = Job::where('slug', $slug)->first();
            if($job){
    		    $users_applications = $job->application->users()->paginate(16);
            }else {
                return abort(404);
            }
    		return view('companyapplications.jobapplications', compact('job', 'users_applications', 'id'));
    	}else {
    		return abort(404);
    	}
    }

    public function reject(Request $request) {
        $user_id = $request->user_id;
        $application_id = Job::where('slug', $request->slug)->first()->application->id;
        
        $user = DB::table('application_user')->where('user_id', $user_id)->where('application_id', $application_id);

        if($user->first()->accepted == 0) {

            if($request->reject) {
                if($user->update(['accepted' => -1])) {
                    return redirect()->back();
                }
            }else if($request->accept) {
                if($user->update(['accepted' => 1])) {
                    return redirect()->back();
                }
            }

        }else {
            abort(404);
        }
    }

}
