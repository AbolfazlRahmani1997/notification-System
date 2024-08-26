<?php

namespace App\Services\SmsProviderStrategy;

use App\Exceptions\ProviderFailedException;
use App\Services\Interfaces\SmsServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Http;
class SmsKavenegarProvider implements SmsServiceProviderInterface
{


    public function __construct()
    {
        $this->api_url =config('sms_service_providers.kavenegar.api_url');
        $this->api_key = config('sms_service_providers.kavenegar.api_key');;
    }

    public function sendSms(string $to, string $message)
    {
        $url=str_replace("{API-KEY}", $this->api_key, $this->api_url);
        $response = Http::get($url, ['message' => urlencode($message), 'receptor' =>$to]);



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
