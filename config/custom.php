<?php

return [
    'gmo_api_url' => env('GMO_API'),
    'gmo_site_id' => env('GMO_SITE_ID'),
    'gmo_site_password' => env('GMO_SITE_PASSWORD'),
    'gmo_shop_id' => env('GMO_SHOP_ID'),
    'gmo_shop_password' => env('GMO_SHOP_PASSWORD'),
    'gmo_member_prefix' => env('GMO_MEMBER_PREFIX'),
    'gmo_order_prefix' => env('GMO_ORDER_PREFIX'),
    'cache' => [
        'verify_email_code' => 'verify_email_code_',
        'reset_email_code' => 'reset_email_code_'
    ]
];
