<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

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

        $numlength = strlen((string)$comment->id);

        $comment_parent = '';

        if($numlength == 1) $comment_parent = '000'. (string)$comment->id;
        if($numlength == 2) $comment_parent = '00'. (string)$comment->id;
        if($numlength == 3) $comment_parent = '0'. (string)$comment->id;
        if($numlength == 4) $comment_parent = (string)$comment->id;

        Comment::where('id', $comment->id)->update(['comments_parents' => $comment_parent]);
        
        $comment = Comment::select([
            'comments.id',
            'comments.content',
            'comments.comments_parents',
            'users.username',
            'users.image_url',
            'comments.user_id',
            'comments.like_sum'
            ])
            ->join('users', 'users.id', "=", "comments.user_id")
            ->where("comments.id", $comment->id)->get();

        return $comment;
    }
   
    public function replies($comment_id, Request $request) {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $request->validate([
            'content' => 'required'
        ]);

        $comment = Comment::where('id', $comment_id)->first();

        $reply = new Comment([
            'user_id' => Auth::user()->id,
            'blog_id' => $request->blog_id,
            'content' => $request->content,
        ]);

        $reply->save();

        $numlength = strlen((string)$reply->id);

        $comment_parent = '';

        if($numlength == 1) $comment_parent = '000'. (string)$reply->id;
        if($numlength == 2) $comment_parent = '00'. (string)$reply->id;
        if($numlength == 3) $comment_parent = '0'. (string)$reply->id;
        if($numlength == 4) $comment_parent = (string)$reply->id;

        $parent = $comment->comments_parents . "." . $comment_parent;
        
        $reply->comments_parents = $parent;

        Comment::where('id', $reply->id)->update(['comments_parents' => $parent]);

        $comment = Comment::select([
            'comments.id',
            'comments.content',
            'comments.comments_parents',
            'users.username',
            'users.image_url',
            'comments.user_id'
            ])
            ->join('users', 'users.id', "=", "comments.user_id")
            ->where("comments.id", $reply->id)->get();

        return $comment;
    }

    public function loadComment($slug) {
        $blog = Blog::where('slug', $slug)->first();
        $comments = Comment::select([
                            'comments.id',
                            'comments.content',
                            'comments.comments_parents',
                            'users.username',
                            'users.image_url',
                            'comments.user_id',
                            'comments.like_sum'
                            ])
                            ->join('users', 'users.id', "=", "comments.user_id")
                            ->where("comments.blog_id", $blog->id)->orderBy("comments_parents", "asc")->get();
        
        return $comments;
    }

    public function deleteComment($id, Request $request) {

        $request->validate([
            'id_blog' => 'required',
        ]);
        $id_comment = $id;

        $numlength = strlen($id_comment);

        if($numlength == 1) $id_comment = '000'. $id_comment;
        if($numlength == 2) $id_comment = '00'. $id_comment;
        if($numlength == 3) $id_comment = '0'. $id_comment;
        if($numlength == 4) $id_comment = $id_comment;

        $comments = Comment::where('blog_id', $request->id_blog)->orderBy("comments_parents", "desc")->get();

        foreach ($comments as $key => $comment) {
            if(Str::contains($comment->comments_parents, $id_comment)) {
                Like::where('id_comment', $comment->id)->delete();
                Comment::where('comments_parents', $comment->comments_parents)->delete();   
            }
            else unset($comments[$key]);
        }
        
        return $comments;
    }
}