<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PostCategory;

class CategoryController extends Controller
{
    public function index(){
    	$categories = PostCategory::orderBy('id', 'desc')->paginate(20);
    	return view('admin.blog.categories.index', compact('categories'));
    }

    public function store(Request $request) {

    	$rules = [
			'name' => 'required|max:50',
    	];
    	$this->validate($request, $rules);
    	$success = '';
    	if($cat = PostCategory::create($request->all())) {

    		$success .= "<tr>";
    		$success .= "<td>".$cat->name."</td>";
    		$success .= "<td>".$cat->created_at->diffForHumans()."</td>";
    		$success .= "<td class='text-right'>";
    		$success .= "<div class='dropdown'>";
            $success .= "</div>";
            $success .= "</td>";
    		$success .= "</tr";
    	}
    	return response()->json([
    		'success' => $success
    	], 200);
    }

    public function edit(PostCategory $category) {
    	return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, PostCategory $category) {
    	$rules = [
			'name' => 'required|min:4|max:50',
    	];

    	$this->validate($request, $rules);

    	if($category->update($request->all())) {
    		return redirect('/admin/categories/'.$category->id.'/edit')->withStatus("Category successfully updated");
    	}else {
    		return redirect()->back()->withStatus("Something wrong, Try again");
    	}
   	}

   	public function show($category) {
   		return abort(404);
   	}

    public function destroy(PostCategory $category) {
    	$category->delete();
    	return redirect()->back()->withStatus("Category successfully deleted");
    }

}
