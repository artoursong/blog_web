<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BlogService;


class BlogController extends Controller
{
    protected BlogService $blogservice;

    public function __construct()
    {
        $this->blogservice = new BlogService();
    }
    
    public function getCreateForm() {
        return $this->blogservice->getCreateForm();
    }

    public function createBlog($id, Request $request) {
        return $this->blogservice->createBlog($id, $request);
    }

    public function getBlog($slug) {
        return $this->blogservice->getBlog($slug);
    }

    public function getNewBlogs() {
        return $this->blogservice->getNewBlogs();
    }
    
    public function getBlogsOfUser($id) {
        return $this->blogservice->getBlogsOfUser($id);
    }

    public function editBlog($id, $slug) {
        return $this->blogservice->editBlog($id, $slug);
    }

    public function updateBlog($id, $id_blog, Request $request) {
        return $this->blogservice->updateBlog($id, $id_blog, $request);
    }

    public function deleteBlog($id, $id_blog) {
        return $this->blogservice->deleteBlog($id, $id_blog);
    }
}
