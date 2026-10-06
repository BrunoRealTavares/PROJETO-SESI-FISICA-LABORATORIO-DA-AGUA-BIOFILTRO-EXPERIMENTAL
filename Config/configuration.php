<?php

return [
    'db' => [
        'host'     => '127.0.0.1',
        'port'     => '3306',
        'dbname'   => 'qualidade_agua',
        'username' => 'root',
        'password' => '',
        'charset'  => 'utf8mb4',
    ],

    'app' => [
        'name'      => 'Laboratório da Água e Biofiltro',
        'env'       => 'development',
        'debug'     => true,
        'base_url'  => 'http://localhost/PROJETO%20SESI%20%20FÍSICA%20(LABORATÓRIO%20DA%20ÁGUA%20+%20BIOFILTRO%20EXPERIMENTAL)/',
        'timezone'  => 'America/Bahia',
    ],

    'standards' => [
        'ph_min'         => 6.0,
        'ph_max'         => 9.5,
        'turbidez_max'   => 5.0,
        'cloro_min'      => 0.2,
        'cloro_max'      => 5.0,
    ]
];