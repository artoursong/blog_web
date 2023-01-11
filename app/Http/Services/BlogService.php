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

class BlogService extends ConvertSlug
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
            'categories' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $slug = $request->title ." " .date("h:i:s", time()) ." " .strval(rand(0, 10000));
        $slug = $this->convert_name($slug);
        
        $blog = new Blog([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $id,
            'slug' => $slug,
            'image_url' => $imageName,
            'subtitle'=> $request->subtitle,
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

    public function getBlog($slug) {
        $blog = Blog::where('slug', $slug)->first();
        $view = view('blog.blog')->with('blog', $blog);
        return $view;
    }

    public function getNewBlogs() {
        $blogs = Blog::orderBy('id', 'desc')->select('id', 'title', 'subtitle', 'image_url', 'slug', 'created_at')->take(2)->get();
        foreach($blogs as $item) {
            $item->content = substr($item->content, 0, 50);
        }
        
        $view = view('home.home')->with('blogs', $blogs);
        return $view;
    }

    public function getBlogsOfUser($id) {
        $blogs = Blog::where('user_id', $id)->get(['title', 'subtitle', 'image_url', 'slug']);
        $view = view('blog.blog_user')->with('blogs', $blogs);
        return $view;
    }
}