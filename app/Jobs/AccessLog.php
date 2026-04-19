<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class AccessLog implements ShouldQueue
{
    use Queueable;
    

    private $userId; 

    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'user_login' => Auth::user()->id,
            'time_login' => Carbon::now()
        ];
        for ($i = 0; $i < 100000; $i++) {
          $data = [
            'user_login' => Auth::user()->id,
            'time_login' => Carbon::now()
        ];  
        }
        Log::info(json_encode($data));
    }
}
