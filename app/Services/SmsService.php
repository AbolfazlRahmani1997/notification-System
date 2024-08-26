<?php

namespace App\Services;

use App\Enums\SMSPanelTypeEnum;
use App\Exceptions\ProviderFailedException;
use App\Jobs\SendSms;
use App\Services\Interfaces\SmsServiceProviderInterface;
use App\Services\SmsProviderStrategy\SmsIdepardazanProvider;
use App\Services\SmsProviderStrategy\SmsKavenegarProvider;
use App\Services\SmsProviderStrategy\SmsRedisProvider;
use Illuminate\Support\Facades\Cache;

class SmsService
{
    private SmsServiceProviderInterface $provider;

    protected array $alternative;


    public function __construct(int $provider = 1, array $alternative = null)
    {

        $this->provider = $this->providerFactory(SMSPanelTypeEnum::from($provider));
        $this->alternative = $alternative;

    }


    public function sendMessageOneToOne(string $phone_number, string $message)
    {
        try {
            $this->provider->sendSms($phone_number, $message);
        } catch (ProviderFailedException $e) {
            if (count($this->alternative) > 0) {
                dispatch(new SendSms(to: $phone_number, topic: $message, provider: $this->alternative[0], alternative: $this->alternative));
            } else {
                $this->provider = new SmsRedisProvider();
                $this->provider->sendSms($phone_number, $message);
            }


        }
    }


    private function providerFactory(SMSPanelTypeEnum $enum): SmsServiceProviderInterface
    {
        return match ($enum) {
            SMSPanelTypeEnum::SMSIDEHPARDAZAN => new SmsIdepardazanProvider(),
            SMSPanelTypeEnum::KAVENEGAR => new SmsKavenegarProvider(),
            default => new SmsRedisProvider(),
        };

    }


}
