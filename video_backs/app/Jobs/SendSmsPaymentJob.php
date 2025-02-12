<?php

namespace App\Jobs

use holoo\modules\Bases\servers\sms\SmsInterface;
use holoo\modules\Smss\Http\Contracts\SmssInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SendSmsPaymentJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $phoneNumber, protected $message)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(SmsInterface $sms)
    {

        return $sms->send($this->phoneNumber, $this->message);
    }

}
