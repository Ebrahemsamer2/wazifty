<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Job;
class JobController extends Controller
{
    public function index() {
    	$jobs = Job::all();
    	return view('jobs.index', compact('jobs'));
    }

    public function show($slug) {
    	$job = Job::where('slug',$slug)->get();
    	return view('jobs.show', compact('job'));
    }
}
