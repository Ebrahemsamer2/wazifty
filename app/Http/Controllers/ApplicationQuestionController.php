<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Application;
use App\Question;

class ApplicationQuestionController extends Controller
{

    public function __construct() {
        return $this->middleware(['auth', 'onlycompany']);
    }

    public function index() {
        $user = auth()->user();
        $jobs_ids = [];
        $user_jobs = $user->jobs;

        foreach($user_jobs as $job)
            $jobs_ids[] = $job->id;

        $applications = Application::whereIn('job_id',$jobs_ids)->orderBy('id','desc')->paginate(12);
        return view('applicationQuestions.index', compact('applications'));
    }

    public function show($id) {
        $application = Application::findOrFail($id);
        return view('applicationQuestions.show', compact('application'));
    }

    public function addquestions(Request $request, $id) {
        $application = Application::findOrFail($id);
        
        $i = count($application->questions) + 1;

        while($request->has('question'.$i)) {
            Question::create(['title' => $request->input('question'.$i),'application_id' => $application->id]);
            $i++;
        }
        return redirect('/company/jobs/applications/'.$application->id)->withStatus('Questions successfully created to this application.');
    }
}
