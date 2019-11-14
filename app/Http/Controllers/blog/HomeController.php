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
    	$hottest_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();

    	$hottest_authors = User::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();

    	return view('blog.home', compact('posts', 'categories', 'hottest_posts', 'hottest_authors'));
    }

    public function getPostsByCategory($category) {
    	$categories = PostCategory::orderBy('id', 'desc')->get();
        $hottest_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();

        $hottest_authors = User::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();

        $category = PostCategory::with('posts')->where('name', $category)->first();
        if($category) {
    		$posts = $category->posts()->orderBy('id', 'desc')->paginate(20);
    		return view('blog.postsby', compact('category','posts', 'categories','hottest_posts','hottest_authors'));
    	}else {
    		return abort(404);
    	}
    }

    public function getPostsByTag($tag) {	
        $categories = PostCategory::orderBy('id', 'desc')->get();
        $hottest_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();

        $hottest_authors = User::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();

    	$posts = Post::where('tags','LIKE','%'.$tag.'%')->orderBy('id', 'desc')->paginate(20);
    	if($posts) {
    		return view('blog.postsby', compact('tag', 'posts', 'categories','hottest_posts','hottest_authors'));
    	}else {
    		return abort(404);
    	}
    }

    public function getPostsByAuthor($author) {	
        $categories = PostCategory::orderBy('id', 'desc')->get();

        $hottest_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();

        $hottest_authors = User::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();

    	$author = User::with('posts')->where('name',$author)->first();
    	if($author) {
    		$posts = $author->posts()->orderBy('id', 'desc')->paginate(20);
    		return view('blog.postsby', compact('author', 'posts', 'categories','hottest_posts','hottest_authors'));
    	}else {
    		return abort(404);
    	}
    }


    public function search(Request $request) {
        $categories = PostCategory::orderBy('id', 'desc')->get();

        $hottest_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();

        $hottest_authors = User::withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();
        $q = $request->q;

        $results = Post::where('title','LIKE','%'.$q.'%')->orWhere('body','LIKE','%'.$q.'%')->orWhere('tags','LIKE','%'.$q.'%')->get();

        $category_result = PostCategory::with('posts')->where('name','LIKE','%'.$q.'%')->first();
        if($category_result){
            if(count($category_result->posts)) {
                $results = $category_result->posts->merge($results);
            }
        }

        return view('blog.search', compact('results','categories','hottest_posts','hottest_authors', 'q'));
    }
}
