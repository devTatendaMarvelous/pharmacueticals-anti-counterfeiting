<?php


namespace App\Business\Services;

use Illuminate\Support\Facades\Session;

define('MAX_EXECUTION_TIME', '600000');
ini_set('max_execution_time', MAX_EXECUTION_TIME);

class ClientWrapper
{

    public function __construct()
    {
    }


    public static function postRequest($data)
    {
        // dd($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://easy.flixtechs.co.zw/api/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('FLIXTECHS_TOKEN'),
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        return @json_decode(json_encode(json_decode($response, true)));
    }













    //   CURLOPT_POSTFIELDS =>'{"name":"Tateenda Marvelous Chimusoro",
    // "merchant_email":"marveloustchimusoro@gmail.com",
    // "phone":"0784657168",
    // "reference":"test",
    // "amount":20
    // }',
    //   CURLOPT_HTTPHEADER => array(
    //     'Content-Type: application/json',
    //     'Authorization: Bearer sGyEmGRBhD4YWGhGfsSJvCOlvISgiynDeoAcpa6q'
    //   ),
    // ));

}
