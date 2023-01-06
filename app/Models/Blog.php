<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'content',
        'image_url',
        'is_delete',
        'like_sum',
        'user_id'
    ];

    protected $guarded=[
        'create_at',
        'update_at'
    ];

    public function users() {
        return $this->hasMany(user::class);
    }
}
