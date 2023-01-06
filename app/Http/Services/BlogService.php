<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Cateofpost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BlogService
{
    public function getCreateForm() {
        $categories = Category::all();
        $view = View::make('blog.create_blog')->with('categories', $categories);
        return $view;
    }

    public function createBlog($id, Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required'
        ]);
        
        $blog = new Blog([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $id
        ]);

        $blog->save();

        $categories = $request->input('categories');

        foreach($categories as $value) {
            $cateofpost = new Cateofpost([
                'blog_id' => $blog->id,
                'cate_id' => $value,
            ]);

            $cateofpost->save();
        }

        return back()->with('status', 'create blog successfully');

    }

    public function getBlog($id) {
        $blog = Blog::where('id', $id)->first();
        $view = view('blog.blog')->with('blog', $blog);
        return $view;
    }
}