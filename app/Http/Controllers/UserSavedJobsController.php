<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserSavedJobsController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	$user = auth()->user();
    	$saved_jobs = $user->saved_jobs;

    	return view("usersavedjobs.index", compact('user', 'saved_jobs'));
    }

    public function save(Request $request) {
            
        $user = auth()->user();
        $job_id = $request->job_id;

        if($request->has('save')) {
                DB::table('user_saved_jobs')->insert([
                'user_id' => $user->id,
                'job_id' => $job_id,
            ]);
        }else {
            DB::table('user_saved_jobs')->where('user_id', $user->id)->where('job_id', $job_id)->delete();
        }
        if($request->has('save'))
            return redirect()->back()->withStatus('Job successfully saved');
        else 
            return redirect()->back()->withStatus('Job successfully unsaved');
    }

}
