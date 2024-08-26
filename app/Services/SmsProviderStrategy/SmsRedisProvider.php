<?php

namespace App\Services\SmsProviderStrategy;

use App\Exceptions\ProviderFailedException;
use App\Services\Interfaces\SmsServiceProviderInterface;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Http;

class SmsRedisProvider implements SmsServiceProviderInterface
{



    public function __construct()
    {
        $this->redis = new \Redis();
    }

    public function sendSms(string $to, string $message)
    {

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
