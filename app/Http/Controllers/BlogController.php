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
        $view = View::make('blog.create_blog');
        return $view;
    }
}
