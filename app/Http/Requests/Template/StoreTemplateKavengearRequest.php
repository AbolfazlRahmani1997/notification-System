<?php

namespace App\Http\Requests\Template;

use App\Enums\SMSPanelTypeEnum;
use App\Rules\ParameterValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateKavengearRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'provider' => ['required', 'integer', 'in:' . implode(',', SMSPanelTypeEnum::values())],
            "template_name" => ['required', 'string'],
            'parameter'=>['array'],
            'parameter_value'=>['array',ParameterValue::class],
        ];
    }
}
