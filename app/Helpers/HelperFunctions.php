<?php

use Carbon\Carbon;
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

function convertToIranFormat($mobileNumber): array|bool|string|null
{
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

function sendSms($mobile, $msg): string
{
    $response = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post('https://panel.asanak.com/webservice/v1rest/sendsms', [
            'username' => 'farzad1forouzanfar',
            'password' => 'F@rzad306762',
            'Source' => '98210000925306762',
            'Message' => $msg,
            'destination' => convertToIranFormat($mobile)
    ]);

    return $response->body();
}

/**
 * @param string $mobile
 * @return int
 */
function generateRandomAuthCode($mobile): int
{
    $code          = mt_rand(1000, 9999);
    $sampleMsgSms  = config('app.sampleMsgSms');
    $msg           = str_replace('code', $code, $sampleMsgSms['auth']);

    $msgID = sendSms($mobile, $msg);

    Log::info("TransactionCode: {$msgID}, Code: $code");
    return $code;
}

function jalaliToJDN($year, $month, $day): float|int
{
    return (1461 * ($year + 4800 + ($month - 14) / 12)) / 4 +
        (367 * ($month - 2 - 12 * (($month - 14) / 12))) / 12 -
        (3 * (($year + 4900 + ($month - 14) / 12) / 100)) / 4 +
        $day - 32075;
}

function jalaliToGregorian($jalaliDate): string
{
    list($jalaliYear, $jalaliMonth, $jalaliDay) = explode('/', $jalaliDate);

    $jdn = jalaliToJDN($jalaliYear, $jalaliMonth, $jalaliDay);

    return Carbon::createFromFormat('Y-m-d', '1582-10-15')->addDays($jdn - 2299160)->toDateString();
}
