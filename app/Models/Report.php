<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $fillable = ['reason_id', 'report_element_type', 'report_element_id', 'report_user_id'];
}
