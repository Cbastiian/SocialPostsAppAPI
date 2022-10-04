<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportPunishManagement extends Model
{
    use HasFactory;
    protected $table = 'report_punish_management';
    protected $fillable = ['report_id', 'message', 'is_punished', 'is_auto_punished'];
}
