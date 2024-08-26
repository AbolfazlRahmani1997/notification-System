<?php

namespace App\Services\SmsProviderStrategy;

use App\Exceptions\ProviderFailedException;
use App\Services\Interfaces\SmsServiceProviderInterface;

class SmsIdepardazanProvider implements SmsServiceProviderInterface
{


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
