<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsPanel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active', 'panel_type','config'];

    protected $casts=['config'=>'array'];
}
