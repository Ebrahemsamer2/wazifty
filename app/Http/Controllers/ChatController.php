<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;

class ChatController extends Controller
{
    public function __construct() {
    	$this->middleware(['auth', 'onlycompany']);
    }

    public function getChat($id) {

    	$user = User::findOrFail($id);

    	if(! $user || $user->emp_type == "employer") {
    		return abort(404);
    	}
    	$messages = Chat::where(function($query) use ($id) {
    		$query->where('user_id', $id)->where('company_id', auth()->user()->id);
    	})->get();

        $contact_users = Chat::where('company_id', auth()->user()->id)
        ->select('user_id')->groupBy('user_id')->get();

        if($messages) {
            Chat::where('user_id', $user->id)->where('company_id', auth()->user()->id)->update(['read' => 1]);
    	   return view('chat.companychat', compact('user', 'messages', 'contact_users'));
        }else {
            return abort(404);
        }
    }

    public function send(Request $request) {

    	$rules = [
    		'user_id' => 'required',
    		'company_id' => 'required',
    		'from' => 'required',
    		'read' => 'required',
    		'message' => 'required',
    	];

    	$this->validate($request, $rules);

    	$data = $request->all();

        $success = '';
        $fail = '';
    	if(Chat::create($data)) {
    	   $success = "<div class='alert alert-success'>Message has been sent.</div>";
    	}else {
            $fail = "<div class='alert alert-danger'>Something is wrong, Try again.</div>";
        }
    	return response()->json([
	    	'success' => $success,
            'fail' => $fail,
	    ], 200);
    }
}
