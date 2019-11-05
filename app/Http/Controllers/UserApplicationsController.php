<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Answer;

class UserApplicationsController extends Controller
{
   
	public function __construct() {
		$this->middleware(['auth', 'onlyuser']);
	}

	public function index() {
		$user = auth()->user();
		$applications = $user->applications()->orderBy('pivot_created_at', 'desc')->paginate(12);
		return view('userapplications.index', compact('user', 'applications'));
	}

	public function update_answers(Request $request) {

        $user_id = auth()->user()->id;
        // check if there are some questions related to this job or not.
        
        $rules = [];
        for($i = 1; $i <= $request->questions_number; $i++) {
        	$rules["answer{$i}"] = 'required|string|max:500';
        	$rules["question{$i}"] = 'required|integer';
        }

        $answers = [];
        $questions_ids = [];
        for($i = 1; $i <= $request->questions_number; $i++) {
            $answers[] = $request->all()["answer{$i}"];
            $questions_ids[] = $request->all()["question{$i}"];
        }

        $this->validate($request, $rules);

        for($i = 0; $i < $request->questions_number; $i++) {
            $answer = Answer::where('id', $request->all()["answer_id" . ($i + 1)])->first();
            $answer->update([
                "the_answer" => $answers[$i],
                "question_id" => $questions_ids[$i],
                "user_id" => $user_id,
            ]);
        }
        return redirect()->back()->withStatus("Your answers successfully updated.");

    }
}
