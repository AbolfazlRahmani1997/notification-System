<?php

namespace App\Services;

use App\Enums\SMSPanelTypeEnum;
use App\Exceptions\ProviderFailedException;
use App\Jobs\SendSms;
use App\Services\Interfaces\SmsServiceProviderInterface;
use App\Services\SmsProviderStrategy\SmsIdepardazanProvider;
use App\Services\SmsProviderStrategy\SmsKavenegarProvider;
use App\Services\SmsProviderStrategy\SmsRedisProvider;
use Illuminate\Support\Facades\App;
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

    public function sendMessageByTemplate(string $phone_number, string $template_name, array $data)
    {

        try {
            $this->provider->sendSmsByTemplate($phone_number, template_title: $template_name, data: $data);
        } catch (ProviderFailedException $e) {
            if (count($this->alternative) > 0) {
                dispatch(new SendSms(to: $phone_number, topic: $template_name, data: $data, provider: $this->alternative[0], alternative: $this->alternative));
            } else {
                $this->provider = new SmsRedisProvider();
                $this->provider->sendSmsByTemplate($phone_number, $template_name, $data);
            }


        }
    }


    private function providerFactory(SMSPanelTypeEnum $enum): SmsServiceProviderInterface
    {
        return match ($enum) {
            SMSPanelTypeEnum::SMSIDEHPARDAZAN => App::make(SmsIdepardazanProvider::class),
            SMSPanelTypeEnum::KAVENEGAR => App::make(SmsKavenegarProvider::class),
            default => new SmsRedisProvider(),
        };

    }

    public function changeDefaultProvider(SMSPanelTypeEnum $panelTypeEnum): bool
    {
        return Cache::set("default_sms_provider", $panelTypeEnum);
    }


}
