<?php
return [
    'roles' => ['admin', 'dentist', 'staff', 'patient'],
    'redirects' => [
        'admin'   => '/dashboard',
        'dentist' => '/dashboard',
        'staff'   => '/dashboard',
        'patient' => '/my/appointments',
    ],
];
