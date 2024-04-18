<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Wrappers\MailWrapper;

class TransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;


    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {

        $this->data=$data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        dd('sent');
            MailWrapper::transactionSuccess($this->data['email'], [
                'number' => $this->data['number'],
                'amount' => $this->data['order_amount'],
                'balance' => $this->data['balance'],
            ]);

    }
}
