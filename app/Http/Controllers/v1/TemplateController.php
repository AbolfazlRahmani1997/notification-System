<?php

namespace App\Http\Controllers\v1;

use App\Enums\SMSPanelTypeEnum;
use App\Helpers\ResponseWrapper;
use App\Helpers\TwoStepValidator;
use App\Http\Requests\Template\StoreTemplateIdepardazRequest;
use App\Http\Requests\Template\StoreTemplateRequest;
use App\Http\Resources\TemplateResource;
use App\Services\Interfaces\TemplateServiceInterface;
use Illuminate\Http\Request;

class TemplateController
{

    public function __construct(private TemplateServiceInterface $service, private ResponseWrapper $responseWrapper)
    {
    }

    public function store(StoreTemplateRequest $request)
    {
        $data = TwoStepValidator::validationTemplateRequestByType(SMSPanelTypeEnum::tryFrom($request->validated('provider')));
        $data= $this->service->store($data);
        return $this->responseWrapper->setStatus(201)
            ->setData($data)
            ->setResource(TemplateResource::class)
            ->generateSingleResponse();
    }


    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseWrapper
            ->setStatus(200)->setData($this->service->index($request->query()))
            ->setResource(TemplateResource::class)->generateCollectionResponse();
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $data = $this->service->show($id);
        return $this->responseWrapper->setStatus(201)
            ->setData($data)
            ->setResource(TemplateResource::class)
            ->generateSingleResponse();
    }

}
