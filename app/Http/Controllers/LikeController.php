<?php
namespace App\Http\Controllers;

use App\Http\Services\LikeService;


class LikeController extends Controller
{
    protected LikeService $likeservice;

    public function __construct()
    {
        $this->likeservice = new LikeService();
    }

    public function likeOrUnLike($id) {
        return $this->likeservice->likeOrUnLike($id);
    }

    public function checkLike($id) {
        return $this->likeservice->checkLike($id);
    }
}