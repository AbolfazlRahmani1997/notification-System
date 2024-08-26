<?php

namespace App\Helpers;

use App\Enums\SMSPanelTypeEnum;
use App\Http\Requests\Panel\StoreKavenegarRequest;
use App\Http\Requests\Panel\StoreSMSIdehpardazanRequest;
use Illuminate\Support\Facades\App;

class TwoStepValidator
{


    public static function validationRequestByType(SMSPanelTypeEnum $enum)
    {
        switch ($enum) {
            case(SMSPanelTypeEnum::KAVENEGAR):
                return App::make(StoreKavenegarRequest::class)->validated();
            case (SMSPanelTypeEnum::SMSIDEHPARDAZAN):
                return App::make(StoreSMSIdehpardazanRequest::class)->validated();
        }
    }



    private static function validationTemplateRequestByType(SMSPanelTypeEnum $enum)
    {
        switch ($enum) {
            case(SMSPanelTypeEnum::KAVENEGAR):
                return App::make(StoreKavenegarRequest::class)->validated();
            case (SMSPanelTypeEnum::SMSIDEHPARDAZAN):
                return App::make(StoreSMSIdehpardazanRequest::class)->validated();
        }
    }

}
