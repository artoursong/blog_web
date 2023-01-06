<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cateofpost extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable=[
        'blog_id',
        'cate_id'
    ];

    public function blog()
    {
        return $this->hasMany(blog::class);
    }

    public function category() 
    {
        return $this->hasMany(category::class);
    }
}
