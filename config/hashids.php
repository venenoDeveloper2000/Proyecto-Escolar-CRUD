<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        \App\Models\Prueba::class => [
            'salt' => \App\Models\Prueba::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        \App\Models\libro::class => [
            'salt' => \App\Models\libro::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        \App\Models\estudiantes::class => [
            'salt' => \App\Models\estudiantes::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        // infodocentes
        \App\Models\infodocentes::class => [
            'salt' => \App\Models\infodocentes::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        // usuarios
        \App\Models\usuarios::class => [
            'salt' => \App\Models\usuarios::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        // Evaluaciones
        \App\Models\Evaluaciones::class => [
            'salt' => \App\Models\Evaluaciones::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        // Materias
        \App\Models\materias::class => [
            'salt' => \App\Models\materias::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        // Archivos
        \App\Models\archivos::class => [
            'salt' => \App\Models\archivos::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        // Materia Carrera
        \App\Models\materias_carreras::class => [
            'salt' => \App\Models\materias_carreras::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],
        // end of model

    ],

];
