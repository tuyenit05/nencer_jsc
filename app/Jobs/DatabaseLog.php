<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\Receipt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class DatabaseLog implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //xuat ra file log bang receipts
        $receipts = Receipt::orderBy('id', 'desc')->get();
        foreach ($receipts as $receipt) {
            //xuat ra file log
            $data =[
                'id' => $receipt->id,
                'storage_id' => $receipt->storage_id,
                'category_id' => $receipt->category_id,
                'total_price' => $receipt->total_price,
                'quantity' => $receipt->quantity,
                'created_at' => $receipt->created_at,
            ];
            Log::info( json_encode($data)); 
        }
    }
}
