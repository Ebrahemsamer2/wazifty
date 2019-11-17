<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\contactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request) {

    	$rules = [
    		'name' => 'required|max:50',
    		'email' => 'required|email',
    		'subject' => 'max:50',
    		'message' => 'required|string|max:500',
    	];
    	$this->validate($request, $rules);

    	$data = $request->all();
        if( Mail::to("Soltan_algaram41@yahoo.com")->send(new contactMail($data))){
            $success = "<div class='alert alert-success'>We've recieved your message, thanks you.<div>";
        }
        return response()->json(['success' => $success], 200);
    }
}
