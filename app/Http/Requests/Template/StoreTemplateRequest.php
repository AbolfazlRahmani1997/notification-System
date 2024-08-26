<?php

namespace App\Http\Requests\Template;

use App\Enums\SMSPanelTypeEnum;
use App\Http\Requests\Traits\UseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateRequest extends FormRequest
{
    use UseApiRequest;
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
            "parameters"=>['required','array'],
            "parameters_title"=>['required','array']
        ];
    }
}
