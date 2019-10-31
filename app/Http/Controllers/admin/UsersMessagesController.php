<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class UsersMessagesController extends Controller
{
    public function index() {
    	$messages = DB::table('user_messages')->paginate(10);
    	return view('admin.usermessages.index', compact('messages'));
    }

    public function active(Request $request, $id) {
    	dd($request->all());
    }

    public function delete($id) {
    	dd($request->all());
    }
}
