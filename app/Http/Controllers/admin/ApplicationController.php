<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Application;

class ApplicationController extends Controller
{
    public function index()
    {  
        $applications = Application::orderBy('id', 'desc')->paginate(20);
        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        return view('admin.applications.show', compact('application'));      
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirecrt('/admin/applications')->withStatus('Application successfully deleted.');
    }

    public function addquestions(Request $request, $id) {
        dd($request->all());
    }
}
