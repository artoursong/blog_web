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

        $comment_parent = str_pad((string)$comment->id,4,"0",STR_PAD_LEFT);

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

        $comment_parent = str_pad((string)$reply->id,4,"0",STR_PAD_LEFT);

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
                            ->where("comments.blog_id", $blog->id)
                            ->where("comments.is_update", false)
                            ->orderBy("comments_parents", "asc")->get();
        
        return $comments;
    }

    public function deleteComment($id, Request $request) {

        $request->validate([
            'id_blog' => 'required',
        ]);

        $comment = Comment::where('id', $id)->first();

        $comment_parent = $comment->comments_parents;


        $comments = Comment::where('blog_id', $request->id_blog)->orderBy("comments_parents", "desc")->get();

        foreach ($comments as $key => $comment) {
            if(Str::contains($comment->comments_parents, $comment_parent)) {
                Like::where('id_object', $comment->id)->where('type', 'comment')->delete();
                Comment::where('id', $comment->id)->delete();   
            }
            else unset($comments[$key]);
        }
        

        return $comments;
    }

    public function updateComment($id, Request $request) {
        $request->validate([
            'content' => 'required',
            'blog_id' => 'required'
        ]);

        $old_comment = Comment::where('id', $id)->first();

        $new_comment = new Comment([
            'blog_id' => $request->blog_id,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'comments_parents' => $old_comment->comments_parents,
            'like_sum' => $old_comment->like_sum,
        ]);
        
        $new_comment->save();

        Like::where('id_object', $id)->update(['id_object' => $new_comment->id]);

        $old_comment = Comment::where('id', $id)->update(['is_update' => true]);

        return $new_comment;
    }
}