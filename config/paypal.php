<?php

/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'live', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.

    'live' => [
        'client_id'         => 'AZvXVmyLc0UPbwP2d78NA3wnDsGw9OYNXcjOwPQ2ZN-8iQYc-8eAgMyYFjvXX6dsqJ-I2jHc3qUlEN0T',
        'client_secret'      => 'EI0uXngqltbbSvo8JRCM8GyQFUhDHdSs5_7a3sIQUB51ToJfVyXxLWJsAs3mnTmIpYvIa-CbZBxvMpYv',
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   =>  false, // Validate SSL when creating api client.
];
