<?php

namespace App\Jobs;

use App\Services\SmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


class SendSms implements ShouldQueue
{
    use Queueable;

    private SmsService $smsService;

    /**
     * Create a new job instance.
     */
    public function __construct(string $to, string $topic, int $provider, array $alternative)
    {

        $alternative = array_values(array_diff($alternative, [$provider]));
        $this->smsService = new SmsService(provider: $provider, alternative: $alternative);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->smsService->sendMessageOneToOne("09107879978", 'test');
    }
}
