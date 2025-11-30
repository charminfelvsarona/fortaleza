<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SettingModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');
        $path = $uri->getPath();

        // Allow these routes without restriction
        $excludedPaths = [
            'admin', 'login', 'login/auth', 'login/logout', 'maintenance', 'loanuser/login', 'loanuser/register'
        ];

        // Check if current path starts with any excluded path
        foreach ($excludedPaths as $excluded) {
            if (stripos($path, $excluded) === 0) {
                return; // allow access
            }
        }

        // Check system mode
        $settingModel = new SettingModel();
        $mode = $settingModel->getMode();

        if ($mode === 'maintenance') {
            $session = session();
            $user = $session->get('user');

            // If no user or not admin, redirect to maintenance page
            if (!$user || ($user['role'] ?? '') !== 'admin') {
                return redirect()->to(base_url('maintenance'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no changes after
    }
}
