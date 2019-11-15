<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Job;
use App\Post;
use App\User;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with('comments')->orderBy('id', 'desc')->limit(5)->get();
        $users = User::where('admin', 0)->orderBy('id', 'desc')->limit(5)->get();
        $jobs =  Job::where('active', 1)->orderBy('id', 'desc')->limit(5)->get();

        $jobs_count = DB::table('jobs')->count();
        $posts_count = DB::table('posts')->count();
        $users_count = DB::table('users')->count();
        $comments_count = DB::table('comments')->count();

        return view('admin.dashboard', compact('posts', 'users', 'jobs', 'jobs_count', 'posts_count', 'users_count', 'comments_count'));
    }
    
    public function search(Request $request) {
    	dd( $request->input('query') );
    }
}
