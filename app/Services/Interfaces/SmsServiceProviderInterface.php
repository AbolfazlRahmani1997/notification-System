<?php

namespace App\Services\Interfaces;

interface SmsServiceProviderInterface
{

    public function sendSms(string $to, string $message);

    public function sendManyToMany(array $destinations, array $messages);

    public function healthCheck():bool;

}
