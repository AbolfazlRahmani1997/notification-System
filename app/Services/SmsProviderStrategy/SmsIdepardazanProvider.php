<?php

namespace App\Services\SmsProviderStrategy;

use App\Enums\SMSPanelTypeEnum;
use App\Exceptions\ProviderFailedException;
use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Services\Interfaces\SmsServiceProviderInterface;

class SmsIdepardazanProvider implements SmsServiceProviderInterface
{


    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    public function sendSmsByTemplate(string $to, string $template_title,array $data)
    {

       $template_title= $this
           ->repository
           ->filterByProvider(SMSPanelTypeEnum::KAVENEGAR->value)
           ->filterByTitle($template_title)
           ->firstOrFail();

       $data_send=[];
        foreach ($template_title->parameters as $key=>$value )
        {
            $data_send[$value]=$data[$key];
        }

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
