<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Resume;

class ResumeController extends Controller
{
 
    public function index(Request $request)
    {
        if($q = $request->input('q')) {
            $resumes = Resume::where('filename', 'LIKE', '%'.$q.'%')->paginate(20);
        }else {
            $resumes = Resume::orderBy('id', 'desc')->paginate(20);
        }
        return view('admin.resumes.index', compact('resumes'));
    }

    public function show(Resume $resume)
    {
        return view('admin.resumes.show');
    }

    public function destroy(Resume $resume)
    {
        $cv->delete();
        return redirect('/admin/resumes')->withStatus('Cv successfully deleted');
    }
}
