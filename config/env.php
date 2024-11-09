<?php
return [
    'app_url' => env('APP_URL'),
    'vnpay' => [
        'code'        => env('VNPAY_CODE',null),
        'secret'     => env('VNPAY_SECRET', null),
        'url'     => "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html",
        'callback' => env('VNPAY_CALLBACK_URL', null),
    ],
];
