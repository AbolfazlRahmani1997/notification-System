<?php

namespace App\Helpers;

use App\Enums\SMSPanelTypeEnum;
use App\Http\Requests\Panel\StoreKavenegarRequest;
use App\Http\Requests\Panel\StoreSMSIdehpardazanRequest;
use App\Http\Requests\Template\StoreTemplateIdepardazRequest;
use App\Http\Requests\Template\StoreTemplateKavengearRequest;
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



    public static function validationTemplateRequestByType(SMSPanelTypeEnum $enum)
    {
        switch ($enum) {
            case(SMSPanelTypeEnum::KAVENEGAR):
                return App::make(StoreTemplateKavengearRequest::class)->validated();
            case (SMSPanelTypeEnum::SMSIDEHPARDAZAN):
                return App::make(StoreTemplateIdepardazRequest::class)->validated();
        }
    }

}
