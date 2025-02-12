<?php

namespace App\Jobs

use holoo\modules\Bases\servers\sms\SmsInterface;
use holoo\modules\Smss\Http\Contracts\SmssInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $phoneNumber, protected $message, protected $userId, protected $linkId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(SmsInterface $sms, SmssInterface $smss)
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
         // Record SMS history
            $result = $smss->create([
                'user_id' => $this->userId,
                'link_id' => $this->linkId,
                'message' => $this->message,
                'status' => $status,
            ]);


        Log::info('SMS sent', ['resultSms' => $result]);
    }

}
