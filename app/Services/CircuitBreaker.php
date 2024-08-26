<?php

namespace App\Services;

use App\Enums\SMSPanelTypeEnum;

class CircuitBreaker
{
    private array $listOfProviders;
    private \Redis $redis;

    private static self $instance;

    public function __construct()
    {
        $this->redis = new \Redis();
        if ($this->redis->lLen(config('"circuit_breaker.sms_provider.half_open')) == 0 && $this->redis->exists(config('"circuit_breaker.sms_provider.open')) == false) {
            $this->listOfProviders = SMSPanelTypeEnum::priorityList();
            $this->redis->set(config('"circuit_breaker.sms_provider.open'), array_pop($this->listOfProviders));
            foreach ($this->listOfProviders as $provider) {
                $this->redis->lPush(config('"circuit_breaker.sms_provider.open'), $provider);
            }
        }


    }

    public function getCurrent(): int
    {
        return $this->redis->get(config('"circuit_breaker.sms_provider.open'));
    }

    public function setState(string $providerName,)
    {

    }

    public function getState(string $providerName)
    {

    }

    public function failed()
    {
        $currentProvider = $this->redis->get(config('"circuit_breaker.sms_provider.open'));

        //todo : Go To Close Stage
        $this->redis->rPush(config('"circuit_breaker.sms_provider.half_open'), $currentProvider);
        //todo : Check Health service after go on Current(open Stage)
        $halfOpen = $this->redis->lPop("sms_providers_state:half_open");
        //todo :If Passed Healthy Go To Current Else Go To Close stage
        $this->redis->set(config('"circuit_breaker.sms_provider.open'), $halfOpen);

    }


    public function checkHalfOpen()
    {

        $lists = $this->redis->lrange(config("circuit_breaker.sms_provider.close"), 0, -1);

        /**Service check healthyUp**/


    }

}
