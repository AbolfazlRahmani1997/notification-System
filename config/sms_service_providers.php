<?php
return [
    'kavenegar' =>
        ['api_key' => env('KAVENEGAR_API_KEY'),
            "api_url" => env('KAVENEGAR_API_URL')
        ],
    "sms_ir" => [
        'api_key'=>env('SMS_IR_API_KEY'),
        "api_url"=>env('SMS_IR_API_URL')
    ]
];
