<?php

namespace App\Models;

use App\Enums\SMSPanelTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['title', "parameters_title",'parameters', 'provider', 'template_name'];

    protected $casts = [
        'parameters' => "array",
        "parameters_title"=>"array",
        "provider"=>"integer"
    ];

    protected function provider(): Attribute
    {

        return Attribute::make(
            get: function ($value) {

               return SMSPanelTypeEnum::tryFrom($value)->name;
            }
        );
    }
}
