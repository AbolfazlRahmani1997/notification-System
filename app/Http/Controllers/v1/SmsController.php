<?php

namespace App\Http\Controllers\v1;

use App\Enums\SMSPanelTypeEnum;
use App\Jobs\SendSms;
use App\Services\SmsService;
use Illuminate\Support\Facades\Cache;

class SmsController
{
    public function __construct()
    {
    }

    public function send()
    {

        dispatch(new SendSms("10", "50", Cache::get("default_Sms_provider",2), SMSPanelTypeEnum::values()));
    }


}
