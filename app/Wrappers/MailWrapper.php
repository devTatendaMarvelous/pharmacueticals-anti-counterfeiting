<?php

namespace App\Wrappers;


use App\Jobs\FailedTransactionJob;
use App\Mail\Notifications;
use App\Mail\NotTransaction;
use App\Mail\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class MailWrapper
{


    public static function emailNotify($emailAddress, $data)
    {
        $mailData = [
            'products' => $data['products'],
            'address' => $data['address'],
        ];

        Mail::to($emailAddress)->send(new Notifications($mailData));

        return response('', 200);
    }
    public static function failedTransaction($emailAddress, $data)
    {
        $mailData = [
            'number'=>$data['number'],
            'date'=>$data['date'],
            'time'=>$data['time'],

        ];

        Mail::to($emailAddress)->send(new NotTransaction($mailData));

        return response('', 200);
    }
    public static function transactionSuccess($emailAddress, $data)
    {
        $mailData = [
            'number'=>$data['number'],
            'amount' => $data['amount'],
            'balance' => $data['balance'],

        ];

        Mail::to($emailAddress)->send(new Transaction($mailData));

        return response('', 200);
    }
}
