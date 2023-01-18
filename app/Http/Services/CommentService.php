<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Routing\Response;
use Egulias\EmailValidator\Parser\IDLeftPart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CommentService
{
   public function addComment($id, Request $request)
   {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $request->validate([
            'comment' => 'required'
        ]);

        $blog = Blog::where('id', $id)->first();

        $comment = new Comment([
            'content' => $request->comment,
            'blog_id' => $blog->id,
            'user_id' => Auth::user()->id,
        ]);
        $comment->save();

        Comment::where('id', $comment->id)->update(['comments_parents' => $comment->id]);
        
        $comment = Comment::select([
            'comments.id',
            'comments.content',
            'comments.comments_parents',
            'users.username',
            'users.image_url',
            'comments.user_id'
            ])
            ->join('users', 'users.id', "=", "comments.user_id")
            ->where("comments.id", $comment->id)->get();

        return $comment;
    }
   
    public function replies($comment_id, Request $request) {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = Comment::where('id', $comment_id)->first();

        $reply = new Comment([
            'user_id' => Auth::user()->id,
            'blog_id' => $request->blog_id,
            'content' => $request->content,
        ]);

        $comments_parents = $comment->comments_parents . "." . $reply->id;
        
        $reply->comments_parents = $comments_parents;

        $reply->save();

        return back();
    }

    public function loadComment($slug) {
        $blog = Blog::where('slug', $slug)->first();
        $comments = Comment::select([
                            'comments.id',
                            'comments.content',
                            'comments.comments_parents',
                            'users.username',
                            'users.image_url',
                            'comments.user_id'
                            ])
                            ->join('users', 'users.id', "=", "comments.user_id")
                            ->where("comments.blog_id", $blog->id)->orderBy("comments_parents", "desc")->get();

        return $comments;
    }
}