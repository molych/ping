<?php

declare(strict_types=1);

return [
    'v1' => [
        'create' => [
            'success' => 'Your service will be create in the background.',
            'failure' => 'You are must verify your email address before creating a new service.',
        ],
        'update' => [
            'success' => 'Your service will be update in the background.',
            'failure' => 'You are not able to update this service that you not owm.',
        ],
        'delete' => [
            'success' => 'Your service will be deleted in the background.',
            'failure' => 'You cannot delete a service that you do not own.',
        ],
        'show' => [
            'failure' => 'You are not able to view this service that you not owm.',
        ]
    ]
];
