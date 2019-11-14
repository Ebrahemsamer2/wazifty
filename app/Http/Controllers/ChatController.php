<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;

use App\Events\EmployeeContact;

class ChatController extends Controller
{
    public function __construct() {
    	$this->middleware(['auth']);
    }

    public function getUserChat($id) {

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
            Chat::where('user_id', $user->id)->where('company_id', auth()->user()->id)->where('from', 'user')->update(['read' => 1]);

            event(new EmployeeContact($user, auth()->user()->id));

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
    	if($chat = Chat::create($data)) {
    	    $success = "<div class='msg right-msg'>";
            $success .= "<div>";
            if(auth()->user()->picture){
                $success .= "<img src='/images/".auth()->user()->picture->filename." ' width='50' height='50'>";
            }else {
                $success .= "<img src='/images/user.jpg' width='50' height='50'>";
            }
            $success .= "</div>";
            $success .= "<div class='msg-bubble'>";
            $success .= "<div class='msg-info'>";
            $success .= "<div class='msg-info-name'>";
            $success .= auth()->user()->name;
            $success .= "</div>";

            if($chat->created_at) {
                $success .= "<div class='msg-info-time'>";
                $success .= $chat->created_at->diffForHumans();
                $success .= "</div>";
            }
            $success .= "</div>";

            $success .= "<div class='msg-text'>";
            $success .= $chat->message;
            $success .= "</div>";
            $success .= "</div>";
            $success .= "</div>";
            $success .= "</div>";

    	}else {
            $fail = "<div class='alert alert-danger'>Something is wrong, Try again.</div>";
        }
    	return response()->json([
	    	'success' => $success,
            'fail' => $fail,
	    ], 200);
    }

    public function getCompanyChat($id) {

        $user = User::findOrFail($id);
        
        if(! $user || $user->emp_type == "employee") {
            return abort(404);
        }
        $messages = Chat::where(function($query) use ($id) {
            $query->where('company_id', $id)->where('user_id', auth()->user()->id);
        })->get();

        $contact_users = Chat::where('user_id', auth()->user()->id)
        ->select('company_id')->groupBy('company_id')->get();

        if($messages) {
            Chat::where('company_id', $user->id)->where('user_id', auth()->user()->id)->where('from','company')->update(['read' => 1]);
           return view('chat.userchat', compact('user', 'messages', 'contact_users'));
        }else {
            return abort(404);
        }
    }




}
