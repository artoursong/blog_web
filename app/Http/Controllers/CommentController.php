<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentService;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
   public function addComment($slug, Request $request)
   {
      $commentservice = new CommentService();
      return $commentservice->addComment($slug, $request);
   }

   public function loadComment($id) 
   {
      $commentservice = new CommentService();
      return $commentservice->loadComment($id);
   }

   public function replyComment($comment_id, Request $request) 
   {
      $commentservice = new CommentService();
      return $commentservice->replies($comment_id, $request);
   }

   public function deleteComment($id, Request $request) 
   {
      $commentservice = new CommentService();
      return $commentservice->deleteComment($id, $request);
   }

   public function updateComment($id, Request $request) 
   {
      $commentservice = new CommentService();
      return $commentservice->updateComment($id, $request);
   }
}
