<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['title', "parameters_title",'parameters', 'provider', 'template_name'];

    protected $casts = [
        'parameters' => "array",
        "parameters_title"=>"array"
    ];
}
