<?php

namespace App\Jobs;

use App\Services\SmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


class SendSms
{
    use Queueable;

    private SmsService $smsService;

    /**
     * Create a new job instance.
     */
    public function __construct(string $to, private string $topic, private array $data, int $provider, array $alternative)
    {


        $alternative = array_values(array_diff($alternative, [$provider]));
        $this->smsService = new SmsService(provider: $provider, alternative: $alternative);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->smsService->sendMessageByTemplate("09107879978", $this->topic, data: $this->data);
    }
}
