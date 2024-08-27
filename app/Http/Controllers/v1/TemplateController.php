<?php

namespace App\Http\Controllers\v1;

use App\Enums\SMSPanelTypeEnum;
use App\Helpers\ResponseWrapper;
use App\Helpers\TwoStepValidator;
use App\Http\Requests\Template\StoreTemplateIdepardazRequest;
use App\Http\Requests\Template\StoreTemplateRequest;
use App\Services\Interfaces\TemplateServiceInterface;

class TemplateController
{

    public function __construct(private TemplateServiceInterface $service, private ResponseWrapper $responseWrapper)
    {
    }

    public function store(StoreTemplateRequest $request)
    {
        $data = TwoStepValidator::validationTemplateRequestByType(SMSPanelTypeEnum::tryFrom($request->validated('provider')));
        return $this->service->store($data);
    }

}
