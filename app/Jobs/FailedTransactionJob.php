<?php

namespace App\Jobs;

use App\Wrappers\MailWrapper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FailedTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $number;
    public $date;
    public $time;

    /**
     * Create a new job instance.
     */
    public function __construct($user,$number,$date,$time)
    {
       $this->user=$user;
       $this->number=$number;
       $this->date=$date;
       $this->time=$time;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        MailWrapper::failedTransaction($this->user->email,[
           'number'=>$this->number,
            'date'=>$this->date,
            'time'=>$this->time,
        ]);
    }
}
