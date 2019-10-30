<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	$company = auth()->user();
    	return view('companyprofile.index', compact('company'));
    }

    public function update(Request $request, $id) {



    }

}
