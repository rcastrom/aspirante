<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        'fotos'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/photos'),
            'url'=>env('APP_URL').'/foto',
            'visibility'=>'public',
        ],
        'curp'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/curp'),
            'url'=>env('APP_URL').'/curp',
            'visibility'=>'public',
        ],
        'certificados'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/certificados'),
            'url'=>env('APP_URL').'/certificado',
            'visibility'=>'public',
        ],
        'constancias'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/constancias'),
            'url'=>env('APP_URL').'/constancia',
            'visibility'=>'public',
        ],
        'actas'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/actas'),
            'url'=>env('APP_URL').'/acta',
            'visibility'=>'public',
        ],
        'seguros'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/seguros'),
            'url'=>env('APP_URL').'/seguro',
            'visibility'=>'public',
        ],
        'formas'=>[
            'driver'=>'local',
            'root'=>storage_path('app/public/formas_migratorias'),
            'url'=>env('APP_URL').'/forma_migratoria',
            'visibility'=>'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('/foto')=>storage_path('app/public/photos'),
        public_path('/curp')=>storage_path('app/public/curp'),
        public_path('/certificado')=>storage_path('app/public/certificados'),
        public_path('/constancia')=>storage_path('app/public/constancias'),
        public_path('/acta')=>storage_path('app/public/actas'),
        public_path('/seguro')=>storage_path('app/public/seguros'),
        public_path('/forma_migratoria')=>storage_path('app/public/formas_migratorias'),
    ],

];
