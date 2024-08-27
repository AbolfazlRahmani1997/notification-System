<?php

namespace App\Services\SmsProviderStrategy;

use App\Enums\SMSPanelTypeEnum;
use App\Exceptions\ProviderFailedException;
use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Services\Interfaces\SmsServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Http;

class SmsKavenegarProvider implements SmsServiceProviderInterface
{
    /**
     * @var \Illuminate\Container\Container|mixed|object
     */
    private string $api_url;
    /**
     * @var \Illuminate\Container\Container|mixed|object
     */
    private string $api_key;
    private string $lookup_url;
    public function __construct(private TemplateRepositoryInterface $repository)
    {
        $this->api_url = config('sms_service_providers.kavenegar.api_url');
        $this->api_key = config('sms_service_providers.kavenegar.api_key');
        $this->lookup_url = "/verify/lookup.json";
    }
    public function sendSmsByTemplate(string $to, string $template_title, array $data)
    {

        $template_title = $this
            ->repository
            ->filterByProvider(SMSPanelTypeEnum::KAVENEGAR->value)
            ->filterByTitle($template_title)
            ->firstOrFail();
        $data_send = [];
        foreach ($template_title->parameters as $key => $value) {
            $data_send[$value] = $data[$key];
        }
        $data_send['receptor'] = $to;
        $data_send['template'] = $template_title;
        $response = Http::post($this->api_url . $this->api_key . $this->lookup_url, $data_send);

    }



    public function sendSms(string $to, string $message)
    {
        throw new ProviderFailedException("cant send Message from Kan");

    }

    public function sendManyToMany(array $destinations, array $messages)
    {
        // TODO: Implement sendManyToMany() method.
    }


    public function healthCheck(): bool
    {
        // TODO: Implement healthCheck() method.
    }
}
