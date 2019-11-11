<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Thumbnail;

class PostController extends Controller
{

    public function index()
    {   
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.posts.create');
    }

    public function store(Request $request)
    {   

        $rules = [
            'title' => 'required|min:50|max:150',
            'body' => 'required|min:500|max:10000',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'thumbnail' => 'required',
        ];

        $this->validate($request, $rules);
        
        $data = $request->except(['thumbnail']);
        
        $data['slug'] = implode('-', explode(' ', $data['title']));
        if($post = Post::create($data)) {

            if($file = $request->file('thumbnail')) {
                
                $filename = $file->getClientOriginalName();
                $filesize = $file->getSize();

                $file_to_store = $post->id.'_'.time() . '_'.$filename;

                if(Thumbnail::create([
                    'filename' => $file_to_store,
                    'filesize' => $filesize,
                    'post_id' => $post->id,
                ])) {
                    $file->move('blog_assets/images', $file_to_store);
                }
            }
            return redirect('/admin/blog/posts')->withStatus("Post successfully created");
        }else {
            return redirect('/admin/blog/posts/create')->withStatus("Something wrong, Try again");
        }
    }

    public function edit(Post $post)
    {
        return view('admin.blog.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
         
        $rules = [
            'title' => 'required|min:50|max:150',
            'body' => 'required|min:500|max:10000',
            'category_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        if($request->has('title')) {
            $post->title = $request->title;
        }
        if($request->has('excerpt')) {
            $post->excerpt = $request->excerpt;
        }
        if($request->has('body')) {
            $post->body = $request->body;
        }
        if($request->has('category_id')) {
            $post->category_id = $request->category_id;
        }
        if($request->has('tags')) {
            $post->tags = $request->tags;
        }

        if($file = $request->file('thumbnail')) {

            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $filesize = $file->getSize();
            $file_to_store = $post->id.'_'.time().'_'.$filename;

            if(! in_array($fileextension, ['jpg', 'png'])) {
                return redirect()->back()->withStatus("Wrong Thumbnail Type");
            }
            if($filesize > 1500000) {
                return redirect()->back()->withStatus("Thumbnail size is too large");   
            }

            if($post->thumbnail) {
                $old_post_thumbnail_filename = $post->thumbnail->filename;
                $old_post_thumbnail_id = $post->thumbnail->id;
                Thumbnail::destroy($old_post_thumbnail_id);
                if(file_exists('blog_assets/images/'. $old_post_thumbnail_filename)) {
                    unlink('blog_assets/images/'.$old_post_thumbnail_filename);
                }
            }

            Thumbnail::create([
                'filename' => $file_to_store,
                'filesize' => $filesize,
                'post_id' => $post->id,
            ]);
            $file->move('blog_assets/images', $file_to_store);
        }

        if($post->save()) {
            return redirect('/admin/blog/posts')->withStatus("Post successfully changed");
        } else {
            if($post->isClean()) {
                return redirect()->back()->withStatus("Nothing changed in this post");
            }else {
                return redirect()->back()->withStatus("Something wrong, Try again");
            }
        }
    }

    public function destroy(Post $post)
    {   
        $post_id = $post->id;
        // delete post 
        $post->delete();

        // delete its images and from server and DB
        $deleted_thumbnail = Thumbnail::where('post_id', $post_id)->first();
        if($post->thumbnail) {
            if(file_exists('blog_assets/images'. $deleted_thumbnail->filename)){
                unlink('blog_assets/images'.$deleted_thumbnail->filename);
            }
        }
        $deleted_thumbnail->delete();
        return redirect('/admin/blog/posts')->withStatus('Post successfully deleted');
    }
}
