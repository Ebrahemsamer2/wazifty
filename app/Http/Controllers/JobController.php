<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Job;
use App\Answer;
use App\Category;
use App\Application;

class JobController extends Controller
{

    public function index() {
    	$jobs = Job::where('active', 1)->orderBy('id', 'desc')->paginate(15);
        
    	$cairo_jobs = Job::where('active', 1)->where('work_place', 'cairo')->orderBy('id', 'desc')->limit(3)->get();
    	$alex_jobs = Job::where('active', 1)->where('work_place','LIKE','alex%')->orderBy('id', 'desc')->limit(3)->get();
    	return view('jobs.index', compact('jobs', 'cairo_jobs', 'alex_jobs'));
    }

    public function show($slug) {
        if($job = Job::where('slug','=',$slug)->first()) {
            $related_jobs = Job::where('category_id', $job->category_id)->limit(5)->get();
    	   return view('jobs.show', compact('job', 'related_jobs'));
        }else {

            if($category = Category::where('name','=',$slug)->first()) {
                $jobs = $category->jobs()->where('active',1)->orderBy('id', 'desc')->paginate(10);
                return view('jobs.jobs_at', compact('jobs','category'));
            }else {
                return abort(404);
            }          
        }
    }

    public function apply(Request $request, $slug) {

        $user_id = auth()->user()->id;
        // check if there are some questions related to this job or not.
        
        if($request->has('saveanswers')) {

            // get question numbers of this job
            $job = Job::where('slug','=',$slug)->first();
            $question_numbers = count($job->application->questions);
            
            $rules = [];
            for($i = 1; $i <= count($request->all()) - ($question_numbers + 2); $i++) {
                $rules["answer{$i}"] = 'required|string|max:500';
                $rules["question{$i}"] = 'required|integer';
            }

            $answers = [];
            $questions_ids = [];
            for($i = 1; $i <= $question_numbers; $i++) {
                $answers[] = $request->all()["answer{$i}"];
                $questions_ids[] = $request->all()["question{$i}"];
            }

            $this->validate($request, $rules);

            for($i = 0; $i < $question_numbers; $i++) {
                Answer::create([
                    "the_answer" => $answers[$i],
                    "question_id" => $questions_ids[$i],
                    "user_id" => $user_id,
                ]);
            }
            
            DB::table('application_user')->insert([
                'user_id' => $user_id,
                'application_id' => $job->application->id,
                'created_at' => now(),
            ]);
            return redirect()->back()->withStatus("You successfully applied for this job");

        }else {

            // job has no questions to answer

            DB::table('application_user')->insert([
                'user_id' => $user_id,
                'application_id' => $request->application_id,
                'created_at' => now(),
            ]);
            return redirect()->back()->withStatus("You successfully applied for this job");
        }
    }

    public function jobsByPlace($place) {
        $jobs = Job::where('work_place', $place)->where('active', 1)->orderBy('id', 'desc')->paginate(10);

        return view('jobs.jobs_at', compact('jobs', 'place'));
    }

    public function jobsByCategoryAndPlace($place, $category) {
        $category = Category::where('name','=',$category)->first();
        $jobs = $category->jobs()->where('active', 1)->where('work_place',$place)->orderBy('id', 'desc')->paginate(10);
        return view('jobs.jobs_at', compact('jobs', 'place','category'));
    }


    public function createJob() {
        if(auth()->user()) {
            if(auth()->user()->emp_type == "employer") {
                $cats = Category::all();
                return view("jobs.newjob", compact('cats'));
            }
        }
    }

    public function storeJob(Request $request) {

        $rules = [
            'title' => 'required|string|min:20|max:100',
            'subtitle' => 'nullable|string|min:20|max:200',
            'job_description' => 'required|min:20|max:1000',
            'job_type' => 'required|string|min:5|max:20',
            'exp_from' => 'required|integer',
            'exp_to' => 'required|integer',
            'responsibility' => 'required|min:50|max:1000',
            'requirements' => 'required|min:50|max:1000',
            'skills' => 'required|min:20|max:1000',
            'salary' => 'required|min:4|max:100',
            'work_place' => 'required|min:4|max:50',
            'category_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['user_id'] = auth()->user()->id;
        $data['slug'] = implode('-', explode(' ', $request->title));
        
        if($job = Job::create($data)) {
            $application = Application::create(['job_id' => $job->id]);
            if($request->has('noButton')) {
                return redirect('/company/'.auth()->user()->id)->withStatus('Job successfully created.');
            }else {
                return redirect('/company/jobs/applications/'.$application->id);
            }
        }
    }

    public function edit($id, $slug) {

        if(auth()->user()->id != $id) {
            return abort(404);
        } else {
            $job = Job::where('slug', $slug)->first();
            $cats = Category::all();
            if($job) {
                return view('jobs.edit', compact('job', 'cats'));
            }else {
                return abort(404);
            }
        }
    }

    // active company job 
    public function active(Request $request, $id) {

        if(auth()->user()->id != $id) {
            return abort(404);
        } else {
            $job = Job::findOrFail($request->job_id);
            if($job) {
                $job->update(['active' => $request->active]);
                if($job->save()) {
                    return redirect()->back()->withStatus("Job successfully updated");
                }
            }else {
                return redirect()->back()->withStatus("Job no longer exits");
            }
        }

    }

}
