<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportReasons extends Model
{
    use HasFactory;

    protected $table = 'report_reasons';
    protected $fillable = ['name', 'description', 'code', 'auto_punish_limit'];
}
