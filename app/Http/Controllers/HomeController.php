<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{

    public function index() {
    	return view('home');
    }

    public function contactForm(Request $request) {

    	$rules = [
            'email' => 'required|email',
    		'message' => 'required|string',
    	];

    	$this->validate($request, $rules);

        DB::table('user_messages')->insert([
            'username' => $request->username,
            'email' => $request->email,
            'message' => $request->message
        ]);

    	$success_output = "<div class='alert alert-success'>We got your message, thank you.</div>";   	
        $fail_output = "<div class='alert alert-danger'>Something wrong, Please try again.</div>";     
	    return response()->json([
	    	'success' => $success_output,
            'fail' => $fail_output
	    ], 200);
    	// echo json_encode($output);
    }
}
