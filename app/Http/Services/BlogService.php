<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Cateofpost;
use App\Http\Services\CommentService;
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

        return $this->getBlogsOfUser($id);

    }

    public function getBlog($slug) {
        $blog = Blog::where('slug', $slug)->first();
        $commentService = new CommentService();
        $comments = $commentService->loadComment($slug);
        return view('blog.blog')->with('blog', $blog)->with('comments', $comments);
    }

    public function getNewBlogs() {
        $blogs = Blog::orderBy('id', 'desc')
                        ->select([
                            'id', 
                            'title', 
                            'subtitle', 
                            'image_url', 
                            'slug', 
                            'created_at'
                            ])
                            ->take(2)->get();
        $view = view('home.home')->with('blogs', $blogs);
        return $view;
    }

    public function getBlogsOfUser($id, $status = null) {
        $blogs = Blog::orderBy('id', 'desc')
                    ->where('user_id', $id)
                    ->get([
                        'id', 
                        'title', 
                        'subtitle', 
                        'image_url', 
                        'slug']);
        $view = view('blog.blog_user', [
            'status' => $status
        ])->with('blogs', $blogs);
        return $view;
    }

    public function editBlog($id, $slug) 
    {
        $blog = Blog::select([
                    'blogs.id',
                    'blogs.title', 
                    'blogs.subtitle', 
                    'blogs.content',
                    'cateofposts.cate_id'
                    ])
                    ->join('cateofposts', 'cateofposts.blog_id', '=', 'blogs.id')
                    ->where('blogs.slug', $slug)
                    ->get();
        $categories = Category::all();
        return view('blog.edit_blog')->with('blog', $blog)->with('categories', $categories);
    }

    public function updateBlog($id, $id_blog, Request $request) {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required|image|max:2048',
            'categories' => 'required',
            'content' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $slug = $request->title ." " .date("h:i:s", time()) ." " .strval(rand(0, 10000));
        $slug = $this->convert_name($slug);

        Blog::where('id', $id_blog)->update([
            'title' => $request->title, 
            'content' => $request->content,
            'slug' => $slug,
            'image_url' => $imageName,
            'subtitle' => $request->subtitle
        ]);

        Cateofpost::where('blog_id', $id_blog)->delete();

        $categories = $request->input('categories');

        foreach($categories as $value) {
            $cateofpost = new Cateofpost([
                'blog_id' => $id_blog,
                'cate_id' => $value,
            ]);

            $cateofpost->save();
        }
        
        $blog = Blog::where('id', $id_blog)->first();
        $view = view('blog.blog')->with('blog', $blog)->with('status', 'update success');
        return $view;
    }

    public function deleteBlog($id, $id_blog) {
        $blog = Blog::where('id', $id_blog)->first();
        if(is_null($blog)) {
            return $this->getBlogsOfUser($id, 'blog is not exists');
        }
        else {
            Comment::where('blog_id', $id_blog)->delete();
            Cateofpost::where('blog_id', $id_blog)->delete();
            Blog::where('id', $id_blog)->delete();
            return $this->getBlogsOfUser($id, 'blog is deleted!');
        }
    }
}