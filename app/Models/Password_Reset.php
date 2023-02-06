<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_Reset extends Model
{
    use HasFactory;
    protected $fillable=[
        
    ];

    protected $guarded=[
        'create_at',
        'update_at'
    ];

    public function users() {
        return $this->hasMany(user::class);
    }
}