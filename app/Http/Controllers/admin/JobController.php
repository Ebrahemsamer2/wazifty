<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\JobRequest;

use App\Job;
use App\Category;
use App\Application;

class JobController extends Controller
{
    public function index(Request $request)
    {
        if( $q = $request->input('q') ) {
            $jobs = Job::where('title','LIKE','%'.$q.'%')->orwhere('skills','LIKE','%'.$q.'%')->join('categories','categories.id', '=','jobs.category_id')->select('jobs.*','categories.name')->orderBy('jobs.id', 'desc')->paginate(10);
        }else {
            $jobs = Job::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {   
        $cats = Category::all();
        return view('admin.jobs.create', compact('cats'));
    }

    public function store(JobRequest $request)
    {   
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = implode('-', explode(' ', $request->title));
        if($job = Job::create($data)) {
            $application = Application::create(['job_id' => $job->id]);
            if($request->has('noButton')) {
                return redirect('/admin/jobs')->withStatus('Job successfully created.');
            }else {
                return redirect('/admin/applications/'.$application->id);
            }
        }
    }
    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {   
        $cats = Category::all();
        return view('admin.jobs.edit', compact('job', 'cats'));
    }

    public function update(Request $request, Job $job)
    {      
        // Update Job Activation only
        if($request->has('active')){
            $job->update(['active' => $request->active]);
            $job->save();
            return redirect()->back()->withStatus('Job successfully updated');
            // return redirect('/admin/jobs#' . $job->id)->withStatus('Job successfully updated');
        }else {
            // Or Update The job main information

            $rules = [
                'title' => 'required|string|min:20|max:100',
                'subtitle' => 'nullable|string|min:20|max:200',
                'slug' => 'string|min:20|max:200',
                'job_description' => 'required|min:20|max:1000',
                'job_type' => 'required|string|min:5|max:20',
                'exp_from' => 'required|integer',
                'exp_to' => 'required|integer',
                'responsibility' => 'required|min:50|max:1000',
                'requirements' => 'required|min:50|max:1000',
                'skills' => 'required|min:20|max:1000',
                'salary' => 'required|min:4|max:100',
                'work_place' => 'required|min:4|max:100',
                'category_id' => 'required|integer',
            ];

            $this->validate($request, $rules);

            if($request->has('title')) {
                $job->title = $request->title;
                $job->slug = implode('-', explode(' ', $job->title));
            }
            if($request->has('subtitle')) {
                $job->subtitle = $request->subtitle;
            }
            if($request->has('job_description')) {
                $job->job_description = $request->job_description;
            }
            if($request->has('job_type')) {
                $job->job_type = $request->job_type;
            }   
            if($request->has('exp_from')) {
                $job->exp_from = $request->exp_from;
            }
            if($request->has('exp_to')) {
                $job->exp_to = $request->exp_to;
            }
            if($request->has('responsibility')) {
                $job->responsibility = $request->responsibility;
            }
            if($request->has('requirements')) {
                $job->requirements = $request->requirements;
            }
            if($request->has('skills')) {
                $job->skills = $request->skills;
            }
            if($request->has('salary')) {
                $job->salary = $request->salary;
            }
            if($request->has('work_place')) {
                $job->work_place = $request->work_place;
            }
            if($request->has('category_id')) {
                $job->category_id = $request->category_id;
            }

            if($request->fromadmin) {
               
                if($job->isClean()) {
                    return redirect('/admin/jobs/'. $job->id .'/edit')->withStatus('Nothing changed');
                }else {
                    if($job->save()) {
                        return redirect('/admin/jobs')->withStatus('Job successfully updated');
                    }else {
                        return redirect('/admin/jobs/' . $job->id .'/edit')->withStatus('Something Wrong, Try again');
                    }
                }
            }else {

                if($job->isClean()) {
                    return redirect('/company/{{ auth()->user()->id }}/job/'. $job->slug .'/edit')->withStatus('Nothing changed');
                }else {
                    if($job->save()) {
                        return redirect('/company/'.auth()->user()->id)->withStatus('Job successfully updated');
                    }else {
                        return redirect('/company/{{ auth()->user()->id }}/job/'. $job->slug .'/edit')->withStatus('Something wrong, Try again');
                    }
                }
            }
        }
    }

    public function destroy(Job $job)
    {   
        $job->delete();
        return redirect('/admin/jobs')->withStatus('Job successfully deleted.');
    }
}
