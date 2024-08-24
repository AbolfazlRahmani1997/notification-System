<?php

namespace App\Http\Controllers\v1;

use App\Enums\SMSPanelTypeEnum;
use App\Helpers\ResponseWrapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\StoreKavenegarRequest;
use App\Http\Requests\Panel\StorePanelSmsRequest;
use App\Http\Requests\Panel\StoreSMSIdehpardazanRequest;
use App\Http\Resources\Panel\SmsPanelResource;
use App\Models\SmsPanel;
use App\Services\Interfaces\SmsPanelServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SmsPanelController extends Controller
{
    public function __construct(private SmsPanelServiceInterface $panelService, private ResponseWrapper $responseWrapper)
    {
    }

    public function show(int $id): JsonResponse
    {

        return $this->responseWrapper
            ->setData($this->panelService->find($id))
            ->setResource(SmsPanelResource::class)
            ->setStatus(200)->generateSingleResponse();
    }


    public function store(StorePanelSmsRequest $request): JsonResponse
    {
       $data= $this->validationRequestByType(SMSPanelTypeEnum::from($request->validated('sms_panel_type')));
       return $this->responseWrapper
            ->setData($this->panelService->create($data))
            ->setResource(SmsPanelResource::class)
            ->setStatus(200)->generateSingleResponse();
    }

    private function validationRequestByType(SMSPanelTypeEnum $enum)
    {
        switch ($enum) {
            case(SMSPanelTypeEnum::KAVENEGAR):
                return App::make(StoreKavenegarRequest::class)->validated();
            case (SMSPanelTypeEnum::SMSIDEHPARDAZAN):
                return App::make(StoreSMSIdehpardazanRequest::class)->validated();
        }
    }
}
