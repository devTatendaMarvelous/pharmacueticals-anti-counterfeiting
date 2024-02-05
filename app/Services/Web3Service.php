<?php

namespace App\Services;

use Web3\Contract;
use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

class Web3Service
{
    protected $web3;

    public function __construct()
    {
        $httpProvider = new HttpProvider(new HttpRequestManager('http://127.0.0.1:7545'));
        $this->web3 = new Web3($httpProvider);
    }

    public function getContract($contractAddress, $contractABI)
    {
        return new Contract($this->web3->provider, $contractABI, $contractAddress);
    }

    public function sendTransaction($transactionData)
    {
        $transactionHash = $this->web3->eth->sendTransaction($transactionData);
        return $transactionHash;
    }
}
