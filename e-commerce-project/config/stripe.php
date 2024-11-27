<?php

// config/settings.php

return [
    'STRIPE_KEY' => env('STRIPE_KEY', '0'), // .env dosyasındaki APP_NAME değeri okur
    'STRIPE_SECRET' => env('STRIPE_SECRET', '0'), // .env dosyasındaki SOME_VALUE değeri okur
];
