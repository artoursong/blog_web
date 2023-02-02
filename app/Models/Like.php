<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_object',
        'type',
        'id_users'
    ];

    protected $guarded = [
        'create_at',
        'update_at'
    ];
}
