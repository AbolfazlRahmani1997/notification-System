<?php

namespace App\Http\Requests\Panel;

use App\Enums\SMSPanelTypeEnum;
use App\Http\Requests\Traits\UseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StorePanelSmsRequest extends FormRequest
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
            'name' => ['required','string','min:0'],
            'sms_panel_type' => ['required', 'integer', 'in:' . implode(',', SMSPanelTypeEnum::values())]
        ];
    }
}