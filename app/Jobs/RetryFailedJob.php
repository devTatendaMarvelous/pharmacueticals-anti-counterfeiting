<?php
//
//namespace App\Jobs;
//
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Queue\Jobs\Job;
//use Illuminate\Queue\Failed\FailedJobProvider;
//
//class RetryFailedJob implements ShouldQueue
//{
//    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
//
//    public $job;
//
//    public function __construct(Job $job)
//    {
//        $this->job = $job;
//    }
//
//    public function handle()
//    {
//        $failedJobProvider = app(FailedJobProvider::class);
//        $failedJob = $failedJobProvider->find($this->job->getJobId());
//
//        if ($failedJob) {
//            dispatch($failedJob->getJob());
//        }
//    }
//}
