<?php
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
