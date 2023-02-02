<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use Illuminate\Routing\Response;
use Egulias\EmailValidator\Parser\IDLeftPart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use MicrosoftAzure\Storage\Common\Internal\Validate;

class LikeService
{
    public function addLike ($id) 
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