<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Likeable;

    protected $table = 'post';
    protected $fillable = ['content', 'code', 'file', 'user_id'];
}
