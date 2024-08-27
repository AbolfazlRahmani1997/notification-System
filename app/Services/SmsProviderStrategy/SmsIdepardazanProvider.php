<?php

namespace App\Services\SmsProviderStrategy;

use App\Enums\SMSPanelTypeEnum;
use App\Exceptions\ProviderFailedException;
use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Services\Interfaces\SmsServiceProviderInterface;
use Illuminate\Support\Facades\Http;

class SmsIdepardazanProvider implements SmsServiceProviderInterface
{


    /**
     * @var \Illuminate\Container\Container|mixed|object
     */
    private string $api_url;
    /**
     * @var \Illuminate\Container\Container|mixed|object
     */
    private string $api_key;

    public function __construct(private TemplateRepositoryInterface $repository)
    {

        $this->api_url = config('sms_service_providers.sms_ir.api_url');
        $this->api_key = config('sms_service_providers.sms_ir.api_key');
    }

    public function sendSmsByTemplate(string $to, string $template_title, array $data)
    {

        $template = $this
            ->repository
            ->filterByProvider(SMSPanelTypeEnum::SMSIDEHPARDAZAN->value)
            ->filterByTitle($template_title)
            ->firstOrFail();

        $data_send = [];
        $data_send['templateId'] = $template_title;
        $data_send["mobile"] = $to;
        $parameter = [];
        foreach ($template->parameters as $key => $value) {
            $arr = ["name" => $value, "value" => $data[$key]];
            array_push($parameter, $arr);
        }
        $data_send['parameters'] = $parameter;
        $response = Http::post($this->api_url, $data_send)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'text/plain')
            ->withHeader('x-api-key', $this->api_key);


    }

    /**
     * @throws ProviderFailedException
     */
    public function sendSms(string $to, string $message)
    {
        throw new ProviderFailedException("cant send Message from Idepardazan");
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
