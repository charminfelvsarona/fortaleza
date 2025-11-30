<?php

namespace App\Controllers;

use App\Models\SettingModel;
use App\Models\NetworkLogModel; // ✅ Add this
use CodeIgniter\Controller;

class MaintenanceController extends Controller
{
    protected $logModel;

    public function __construct()
    {
        $this->logModel = new NetworkLogModel(); // ✅ Initialize the logger
    }

    public function index()
    {
        $settingModel = new SettingModel();
        $mode = $settingModel->getMode();

        // ✅ Log access to maintenance route
        $this->logModel->logActivity("accessed the maintenance check route.");

        // If the system is back online, redirect users to login/home
        if ($mode === 'online') {
            // ✅ Log that system was online and user was redirected
            $this->logModel->logActivity("found the system is online and redirected to login page.");

            return redirect()->to(base_url('loanuser/login'));
        }

        // Otherwise, show maintenance view
        $data = [
            'title' => 'System Under Maintenance',
            'message' => 'Our system is currently undergoing maintenance. Please check back later.'
        ];

        // ✅ Log that maintenance mode is active
        $this->logModel->logActivity("viewed maintenance page (system is under maintenance).");

        return view('maintenance', $data);
    }
}
