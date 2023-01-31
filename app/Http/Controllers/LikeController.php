<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LikeService;


class LikeController extends Controller
{
    public function addLike($id, Request $request) {
        $likeService = new LikeService();
        return $likeService->addLike($id, $request);
    }

    public function checkLike($id) {
        $likeService = new LikeService();
        return $likeService->checkLike($id);
    }
}