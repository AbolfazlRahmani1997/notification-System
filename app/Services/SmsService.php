<?php

namespace App\Services;

use App\Enums\SMSPanelTypeEnum;
use App\Exceptions\ProviderFailedException;
use App\Services\Interfaces\SmsServiceProviderInterface;
use App\Services\SmsProviderStrategy\SmsIdepardazanProvider;
use App\Services\SmsProviderStrategy\SmsKavenegarProvider;

class SmsService
{
    private SmsServiceProviderInterface $provider;

    public function __construct(private CircuitBreaker $circuitBreaker)
    {
        $current = $this->circuitBreaker->getCurrent();
        $this->provider = $this->providerFactory(SMSPanelTypeEnum::from($current));
    }


    public function sendMessageOneToOne()
    {
        try {

            $this->provider->sendSms("09107879978", "salam ,");
        } catch (ProviderFailedException $e) {
          $this->circuitBreaker->failed();
          //todo:try_again
        }
    }


    private function providerFactory(SMSPanelTypeEnum $enum): SmsServiceProviderInterface
    {
        switch ($enum) {
            case(SMSPanelTypeEnum::SMSIDEHPARDAZAN):
                return new SmsIdepardazanProvider();
            case (SMSPanelTypeEnum::KAVENEGAR):
                return new SmsKavenegarProvider();
            case (SMSPanelTypeEnum::SMs):
                return new SmsIdepardazanProvider();
        }

    }

}
