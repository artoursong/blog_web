<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Services\BlogService;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
    // private $blogservice;
    
    // public function __construct(BlogService $blogservice = null) {
    //     $this->$blogservice = ($blogservice === null) ? new BlogService : $blogservice;
    // }

    public function getCreateForm() {
        $blogservice = new BlogService();
        return $blogservice->getCreateForm();
    }

    public function createBlog($id, Request $request) {
        $blogservice = new BlogService();
        return $blogservice->createBlog($id, $request);
    }

    public function getBlog($slug) {
        $blogservice = new BlogService();
        return $blogservice->getBlog($slug);
    }

    public function getNewBlogs() {
        $blogservice = new BlogService();
        return $blogservice->getNewBlogs();
    }
    
    public function getBlogsOfUser($id) {
        $blogservice = new BlogService();
        return $blogservice->getBlogsOfUser($id);
    }

    public function editBlog($id, $slug) {
        $blogservice = new BlogService();
        return $blogservice->editBlog($id, $slug);
    }

    public function updateBlog($id, $id_blog, Request $request) {
        $blogservice = new BlogService();
        return $blogservice->updateBlog($id, $id_blog, $request);
    }

    public function deleteBlog($id, $id_blog) {
        $blogservice = new BlogService();
        return $blogservice->deleteBlog($id, $id_blog);
    }
}
