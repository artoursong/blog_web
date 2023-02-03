<?php

namespace App\Http\Services;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function likeOrUnlike ($id) 
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $liked = Like::where('id_users', Auth::user()->id)
                    ->where('id_object', $id)->first();

        if($liked == null) {
            $like = new Like([
                'type' => 'comment',
                'id_object' => $id,
                'id_users' => Auth::user()->id,
            ]);
    
            $like->save();
    
            Comment::where('id', $id)->increment('like_sum', 1);
            $comment = Comment::select([
                'id',
                'like_sum'
            ])
            ->where('id', $id)->first();

            return $comment;
        }
        else {
            Like::where('id_object', $id)
                ->where('id_users', Auth::user()->id)
                ->delete();

            Comment::where('id', $id)->decrement('like_sum', 1);
            $comment = Comment::select([
                'id',
                'like_sum'
            ])
            ->where('id', $id)->first();
            

            return $comment;
        }
    }

    public function checkLike($id_blog) 
    {
        if(Auth::check()) {
            $like = Like::select([
                'id_object'
            ])->join('comments', 'likes.id_object', "=", "comments.id")
            ->where('likes.type', 'comment')
            ->where('comments.blog_id', $id_blog)->get();
            return $like;
        }
        else  {
            return null;
        }
    }
}