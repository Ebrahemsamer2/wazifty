<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Job;
use App\Answer;
use App\Category;

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
}
