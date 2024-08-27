<?php

namespace App\Http\Controllers\v1;

use App\Enums\SMSPanelTypeEnum;
use App\Http\Requests\SMS\SendRequest;
use App\Jobs\SendSms;
use App\Services\SmsService;
use Illuminate\Support\Facades\Cache;

class SmsController
{
    public function __construct()
    {
    }

    public function send(SendRequest $request)
    {

        dispatch(new SendSms(to: "10", topic: $request->validated('type'), data: $request->validated("data"), provider: Cache::get("default_sms_provider", 2), alternative: SMSPanelTypeEnum::values(),));
    }


}
