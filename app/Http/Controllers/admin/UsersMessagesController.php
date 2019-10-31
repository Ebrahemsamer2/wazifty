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

    public function active(Request $request) {
    	
        $updated = DB::table('user_messages')->where('id', $request->message_id)->update([
            'active' => $request->active,
        ]);
        
        if($updated){
            return redirect()->back()->withStatus("Message status successfully updated");
        }else {
            return redirect()->back()->withStatus("Something wrong, Try again");
        }
    }

    public function delete(Request $request) {
    	$deleted = DB::table('user_messages')->where('id', $request->message_id)->delete();
        
        if($deleted){
            return redirect()->back()->withStatus("Message successfully deleted");
        }else {
            return redirect()->back()->withStatus("Something wrong, Try again");
        }
    }
}
