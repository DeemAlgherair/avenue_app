<?php

use Illuminate\Console\View\Components\Secret;

return[
    'api_key'=>[
        'secret'=>env('STRIPE_SECRET')
    ]
];