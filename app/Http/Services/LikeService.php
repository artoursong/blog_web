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
    public function addLike ($id, Request $request) 
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $request->validate([
            'id_blog' => 'required',
        ]);

        $liked = Like::where('id_blog', $request->id_blog)
                    ->where('id_users', Auth::user()->id)
                    ->where('id_comment', $id)->first();

        if($liked == null) {
            $like = new Like([
                'id_blog' => $request->id_blog,
                'id_comment' => $id,
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
            Like::where('id_blog', $request->id_blog)
                ->where('id_users', Auth::user()->id)
                ->where('id_comment', $id)->delete();

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
                'id_comment',
            ])
            ->where('id_blog', $id_blog)
            ->where('id_users', Auth::user()->id)
            ->get();
            return $like;
        }
        else  {
            return null;
        }
    }
}