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
    		'email' => 'required|email|unique:users',
    		'message' => 'required|string'
    	];

    	$this->validate($request, $rules);

		$data = $request->except('_token');
		DB::table('user_messages')->insert($data);

    	$success_output = "<div class='alert alert-success'>We got your message, thank you.</div>";   	
    	$output = [
	    	'success' => $success_output,
	    ];

	    return response()->json([
	    	'success' => $success_output
	    ], 200);
    	// echo json_encode($output);
    }
}
