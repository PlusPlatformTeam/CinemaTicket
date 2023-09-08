<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

function convertDigitsToFarsi($number): array|string
{
    $persianDigits = [
        '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'
    ];

    $englishDigits = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
    ];

    return str_replace($englishDigits, $persianDigits, $number);
}

function getRandomFileName() : string 
{
    return md5(hash('sha256', md5(uniqid().time())));    
}

function convertToIranFormat($mobileNumber) {
    $mobileNumber = preg_replace('/\D/', '', $mobileNumber);

    if (substr($mobileNumber, 0, 2) === '09') {
        return '98' . substr($mobileNumber, 1);
    } 
    elseif (substr($mobileNumber, 0, 3) === '989') {
        return $mobileNumber;
    } 
    elseif (substr($mobileNumber, 0, 4) === '+989') {
        return substr($mobileNumber, 1);
    } 
    else {
        return false;
    }
}

/**
 * @param string $mobile
 * @return int
 */
function generateRandomAuthCode($mobile)
{
    $code = mt_rand(1000, 9999);
    $msg  = "رمز عبورشما: '{$code}'\nسینما تیکت";
    // $response = Http::withoutVerifying()->withHeaders([
    //         'Content-Type' => 'application/x-www-form-urlencoded',
    //     ])->asForm()->post('https://panel.asanak.com/webservice/v1rest/sendsms', [
    //         'username' => 'farzad1forouzanfar',
    //         'password' => 'F@rzad306762',
    //         'Source' => '98210000925306762',
    //         'Message' => $msg,
    //         'destination' => convertToIranFormat($mobile)
    // ]);
    
    // Log::info("TransactionCode: {$response->body()}, Code: $code");
    return $code;
}
