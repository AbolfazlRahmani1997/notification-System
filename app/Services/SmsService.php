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


    public function sendMessageOneToOne(string $phone_number,string $message)
    {
        try {
            $this->provider->sendSms($phone_number, $message);
        } catch (ProviderFailedException $e) {
            $this->circuitBreaker->failed();
            //todo:try_again
        }
    }


    private function providerFactory(SMSPanelTypeEnum $enum): SmsServiceProviderInterface
    {
        return match ($enum) {
            SMSPanelTypeEnum::SMSIDEHPARDAZAN => new SmsIdepardazanProvider(),
            SMSPanelTypeEnum::KAVENEGAR => new SmsKavenegarProvider(),
            default => new SmsIdepardazanProvider(),
        };

    }

}
