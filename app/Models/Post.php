<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = []; //We are telling laravel that it's Ok to not guard anything

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
