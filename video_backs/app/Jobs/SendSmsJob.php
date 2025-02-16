<?php

namespace App\Jobs;

use App\servers\sms\SmsInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
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
        Log::info('Job started', ['phoneNumber' => $this->phoneNumber]);

        try {
            $sms->send($this->phoneNumber, $this->message);
            $status = 'sent';
            return true;
        } catch (\Exception $e) {
            $status = 'failed';
            Log::error('Error sending SMS', ['exception' => $e->getMessage()]);
        }
    }

}
