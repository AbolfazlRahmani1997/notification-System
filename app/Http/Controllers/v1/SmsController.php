<?php

namespace App\Http\Controllers\v1;

use App\Services\SmsService;

class SmsController
{
    public function __construct(private SmsService $service)
    {
    }

    public function send()
    {
        $this->service->sendMessageOneToOne();
    }


}
