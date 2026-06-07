<?php

namespace dacoto\LaravelWizardInstaller\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class InstallServerController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        return view('installer::steps.server', [
            'result' => $this->check()
        ]);
    }

    public function check(): bool
    {
        foreach (config('installer.server') as $check) {
            if (!$check['check']()) {
                return false;
            }
        }

        return true;
    }

    public static function checkPhp(): bool
    {
        return version_compare(PHP_VERSION, '8', '>');
    }

    public static function checkPdo(): bool
    {
        return extension_loaded('pdo_mysql');
    }

    public static function checkMbstring(): bool
    {
        return extension_loaded('mbstring');
    }

    public static function checkFileinfo(): bool
    {
        return extension_loaded('fileinfo');
    }

    public static function checkOpenssl(): bool
    {
        return extension_loaded('openssl');
    }

    public static function checkTokenizer(): bool
    {
        return extension_loaded('tokenizer');
    }

    public static function checkJson(): bool
    {
        return extension_loaded('json');
    }

    public static function checkCurl(): bool
    {
        return extension_loaded('curl');
    }

    public static function checkZip(): bool
    {
        return extension_loaded('zip');
    }
}

