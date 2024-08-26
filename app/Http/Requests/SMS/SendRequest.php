<?php

namespace App\Http\Requests\SMS;

use App\Http\Requests\Traits\UseApiRequest;
use App\Rules\ParameterValue;
use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
            'type'=>['required','exists:templates,template_name'],
            "data"=>['required','array',new ParameterValue()]
        ];
    }
}
