<?php

use Illuminate\Support\Facades\File;

return [
    'icon' => 'assets/horizontal-logo.svg',

    //    'background' => 'assets/logo.svg',

    'support_url' => 'https://teams.live.com/l/invite/FEALDqx1XC04nCUHQE',

    'server' => [
        'php'       => [
            'name'    => 'PHP Version',
            'version' => '>= 8.1.0',
            'check'   => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkPhp']
        ],
        'pdo'       => [
            'name'  => 'PDO',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkPdo']
        ],
        'mbstring'  => [
            'name'  => 'Mbstring extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkMbstring']
        ],
        'fileinfo'  => [
            'name'  => 'Fileinfo extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkFileinfo']
        ],
        'openssl'   => [
            'name'  => 'OpenSSL extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkOpenssl']
        ],
        'tokenizer' => [
            'name'  => 'Tokenizer extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkTokenizer']
        ],
        'json'      => [
            'name'  => 'Json extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkJson']
        ],
        'curl'      => [
            'name'  => 'Curl extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkCurl']
        ],
        'zip'       => [
            'name'  => 'Zip extension',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallServerController::class, 'checkZip']
        ]
    ],

    'folders' => [
        'storage.framework' => [
            'name'  => base_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'framework',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallFolderController::class, 'checkFramework']
        ],
        'storage.logs'      => [
            'name'  => base_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallFolderController::class, 'checkLogs']
        ],
        'storage.cache'     => [
            'name'  => base_path() . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'cache',
            'check' => [\dacoto\LaravelWizardInstaller\Controllers\InstallFolderController::class, 'checkCache']
        ],
    ],

    'database' => [
        'seeders' => false
    ],

    'commands' => [
        'db:seed --class=InstallationSeeder',
        'db:seed --class=AddSuperAdminSeeder',
    ],

    'admin_area' => [
        'user' => [
            'email'    => 'superadmin@gmail.com',
            'password' => 'superadmin'
        ]
    ]
];
