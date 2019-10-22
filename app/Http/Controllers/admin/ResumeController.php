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

    public function download($id) {
        $resume = Resume::findOrFail($id);

        if(file_exists('resumes/'. $resume->filename)) {
            $short_name = explode('_', $resume->filename)[0];
            // file is exist, download it
            return response()->download('resumes/' . $resume->filename, time().'_'.$resume->user->name.'_resume');
        }else {
            // no file here, error respond 
            dd("File does not exist");
        }
    }

    public function destroy($id)
    {   
        $resume = Resume::findOrFail($id);
        $filename = $resume->filename;
        $resume->delete();
        if(file_exists('resumes/' . $filename)) {
            unlink('resumes/' . $filename);
        }
        return redirect('/admin/resumes')->withStatus('Resume successfully deleted');
    }
}
