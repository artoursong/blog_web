<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'image'
    ];

    protected $guarded = [
        'create_at',
        'update_at'
    ];

    public function user()
    {
        return $this->hasMany(user::class);
    }

    public function blog()
    {
        return $this->hasMany(blog::class); 
    }
}
