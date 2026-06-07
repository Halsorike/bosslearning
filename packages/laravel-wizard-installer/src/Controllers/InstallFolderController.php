<?php

namespace dacoto\LaravelWizardInstaller\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class InstallFolderController extends Controller
{
    public function __invoke(): View|Factory|Application|RedirectResponse
    {
        if (!(new InstallServerController())->check()) {
            return redirect()->route('LaravelWizardInstaller::install.server');
        }

        return view('installer::steps.folders', [
            'result' => $this->check()
        ]);
    }

    public function check(): bool
    {
        foreach (config('installer.folders') as $check) {
            if (!$check['check']()) {
                return false;
            }
        }

        return true;
    }

    public static function checkFramework(): bool
    {
        return (int)File::chmod(base_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'framework') >= 755;
    }

    public static function checkLogs(): bool
    {
        return (int)File::chmod(base_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs') >= 755;
    }

    public static function checkCache(): bool
    {
        return (int)File::chmod(base_path() . DIRECTORY_SEPARATOR . 'bootstrap/cache') >= 755;
    }
}

