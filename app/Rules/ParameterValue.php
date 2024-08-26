<?php

namespace App\Rules;

use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Repositories\TemplateRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ParameterValue implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var TemplateRepository $templateRepository */
        $templateRepository = App::make(TemplateRepositoryInterface::class);
        $template = $templateRepository->filterByTitle(Request::get('type'))->firstOrFail();

        if (count($template->parameters_title)!=count($value))
        {
        throw  new HttpException(422,"test");
        }

    }

    public function loadRequest()
    {

    }
}
