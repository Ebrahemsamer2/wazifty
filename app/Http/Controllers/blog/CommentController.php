<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with(['post','user'])->orderBy('id', 'desc')->paginate(20);
        return view('admin.blog.comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('admin.blog.comments.edit', compact('comment'));
    }

    public function store(Request $request) {
        $rules = [
            'comment' => 'required|max:500',
        ];
        
        $this->validate($request, $rules);

        if($request->has('comment')) {
            $comment = Comment::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->post_id,
                'comment_type' => $request->comment_type,
                'comment' => $request->comment,
            ]);

            $success = '<div ';
            if($comment->comment_type == "comment") {
                $success .= 'class="row">';
            }else {
                $success .= 'class="row reply">';
            }
            $success .= '<div class="col-sm-2">';
            $success .= '<div class="commenter-image">';
            if($comment->user->picture) {
                $success .= '<img src="/images/ ' . $comment->user->picture->filename . '" width="80" height="80">';
            }else {
                $success .= '<img src="/images/user.jpg" width="80" height="80">';
            }
            $success .= '</div></div> <div class="col-sm">';
            $success .= '<div class="comment" id="comment'.$comment->id.' " >
            <span class="text-gray">' . $comment->created_at->diffForHumans()  . ' </span>';

            $success .= '<p>'.$comment->comment.'</p>';
        
            // if(Auth::check()) {

            //     if( auth()->user()->id == $comment->user_id ) {

            //         $success .= '<form method="post" action="'.route('comments.store').'">';
            //         $success .= '<a href="" class="btn btn-secondary btn-sm">Edit</a>';
            //         if($comment->comment_type == 'comment') {
            //             $success .= '<a href="" class="btn btn-info btn-sm">Reply</a>';
            //         }else {
            //             $success .= '<input type="submit" value="Delete" class="btn btn-danger btn-sm" />';
            //         }
            //         $success .= '</form></div></div></div>';  
            //     } 
            // }
            $fail = "<div class='alert alert-danger'>Something wrong, please try again</div>";
            return response()->json([
                'success' => $success,
                'fail' => $fail,
            ], 200);
        }

    }

    public function update(Request $request, Comment $comment)
    {
        $rules = [
            'comment' => 'required|max:500',
        ];
        $this->validate($request, $rules);

        if($request->has('comment')) {
            $comment->comment = $request->comment;
        }
        if($comment->isClean()) {
            // nothing changed
            return redirect('/admin/blog/comments/'.$comment->id.'/edit')->withStatus('Nothing changed');
        }else {
            $comment->save();
            return redirect('/admin/blog/comments')->withStatus('Comment successfully updated');
        }
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('/admin/blog/comments')->withStatus('Comment successfully deleted');
    }

}
