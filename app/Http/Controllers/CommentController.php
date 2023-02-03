<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentService;

class CommentController extends Controller
{
   protected CommentService $commentservice;

   public function __construct()
   {
      $this->commentservice = new CommentService();
   }

   public function addComment($slug, Request $request)
   {
      return $this->commentservice->addComment($slug, $request);
   }

   public function loadComment($id) 
   {
      return $this->commentservice->loadComment($id);
   }

   public function replyComment($comment_id, Request $request) 
   {
      return $this->commentservice->replies($comment_id, $request);
   }

   public function deleteComment($id, Request $request) 
   {
      return $this->commentservice->deleteComment($id, $request);
   }

   public function updateComment($id, Request $request) 
   {
      return $this->commentservice->updateComment($id, $request);
   }
}
