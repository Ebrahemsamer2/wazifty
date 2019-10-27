<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Job;
class JobController extends Controller
{
    public function index() {
    	$jobs = Job::where('active', 1)->orderBy('id', 'desc')->paginate(15);
        
    	$cairo_jobs = Job::where('active', 1)->where('work_place', 'cairo')->orderBy('id', 'desc')->limit(3)->get();
    	$alex_jobs = Job::where('active', 1)->where('work_place','LIKE','alex%')->orderBy('id', 'desc')->limit(3)->get();
    	return view('jobs.index', compact('jobs', 'cairo_jobs', 'alex_jobs'));
    }

    public function show($slug) {
    	$job = Job::where('slug',$slug)->get();
    	return view('jobs.show', compact('job'));
    }
}
