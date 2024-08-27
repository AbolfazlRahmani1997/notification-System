<?php

namespace App\Http\Controllers\v1;

use App\Enums\SMSPanelTypeEnum;
use App\Helpers\ResponseWrapper;
use App\Http\Requests\ChangeSmsProviderRequest;
use App\Http\Requests\SMS\SendRequest;
use App\Jobs\SendSms;
use App\Services\Interfaces\JwtServiceInterface;
use App\Services\SmsService;
use Illuminate\Support\Facades\Cache;

class SmsController
{
    public function __construct(private ResponseWrapper $responseWrapper,private JwtServiceInterface $jwtService, private SmsService $service)
    {
    }


    public function generateToken(): string
    {

     return   $this->responseWrapper->generateGeneralLogin( $this->jwtService->generateToken("10")->toString());
    }

    public function send(SendRequest $request)
    {
        dispatch(new SendSms(to: "10", topic: $request->validated('type'),
            data: $request->validated("data"),
            provider: Cache::get("default_sms_provider", 2),
            alternative: SMSPanelTypeEnum::values()));
        return $this->responseWrapper
            ->setStatus(200)
            ->generateSuccessResponse(message: __('messages.success'));
    }


    public function getAllProviders(): array
    {
        return SMSPanelTypeEnum::array();
    }

    public function setProviderOfDefault(ChangeSmsProviderRequest $request)
    {

        $result = $this->service->changeDefaultProvider(SMSPanelTypeEnum::tryFrom($request->validated('sms_panel_provider')));
        if (!$result)
        {
            return $this->responseWrapper
                ->generateFailedResponse(message: __('messages.failed'));
        }
        return $this->responseWrapper
            ->setStatus(200)
            ->generateSuccessResponse(message: __('messages.success'));
    }


}
