<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Post;
use App\PostCategory;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
    	$posts = Post::orderBy('id', 'desc')->paginate(20);

    	$categories = PostCategory::orderBy('id', 'desc')->get();
    	// dd(Post::pluck('category_id')->countBy()->sort()->reverse()->keys()->take(5));
    	$hottest_posts = Post::all();

    	$hottest_authors = User::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();

    	return view('blog.home', compact('posts', 'categories', 'hottest_posts', 'hottest_authors'));
    }
}
