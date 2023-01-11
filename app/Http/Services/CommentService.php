<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
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

   }
   
   public function loadComment($id) 
   {
        $blog = Blog::where('id', $id)->first();
        $comment = Comment::where('blog_id', $blog->id);

        return $comment;
   }
}