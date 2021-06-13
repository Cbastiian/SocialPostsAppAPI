<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRatings extends Model
{
    use HasFactory;

    protected $table = 'product_ratings';
    protected $fillable = ['value', 'user_id', 'product_id', 'comment'];
}
