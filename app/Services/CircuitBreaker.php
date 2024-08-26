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
        if ($this->redis->lLen('sms_providers_state:half_open') == 0) {
            $this->listOfProviders = SMSPanelTypeEnum::priorityList();
            $this->redis->set("sms_provider_state:current", array_pop($this->listOfProviders));
            foreach ($this->listOfProviders as $provider) {
                $this->redis->lPush("sms_providers_state:half_open", $provider);
            }
        }



    }

    public function getCurrent(): int
    {
        return $this->redis->get('sms_provider_state:current');
    }

    public function setState(string $providerName,)
    {

    }

    public function getState(string $providerName)
    {

    }

    public function failed()
    {
        $currentProvider = $this->redis->get("sms_provider_state:current");
        $this->redis->rPush("sms_providers_state:half_open", $currentProvider);
        $halfOpen = $this->redis->lPop("sms_providers_state:half_open");
        $this->redis->set("sms_provider_state:current", $halfOpen);

    }


    public function checkHalfOpen()
    {

        $lists = $this->redis->lrange("sms_providers_close", 0, -1);

        /**Service check healthyUp**/


    }


    public static function getInstance(): CircuitBreaker
    {
        if (empty(self::$instance)) {
            self::$instance = new CircuitBreaker();
        }
        return self::$instance;
    }


}
