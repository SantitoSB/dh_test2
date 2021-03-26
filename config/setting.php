<?php

declare(strict_types=1);

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_ENV') === 'test' || getenv('APP_ENV') === 'dev',
    ],
];
