<?php

namespace App\Controllers;

use App\Models\SettingModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function toggleMode()
    {
        $settingModel = new SettingModel();
        $newMode = $settingModel->toggleMode();

        // ✅ Set a flash message to confirm the change
        session()->setFlashdata('message', "System is now in {$newMode} mode.");

        // ✅ Redirect back to admin dashboard (not maintenance)
        return redirect()->to(base_url('home'));
    }
    public function viewLogs()
{
    $logModel = new \App\Models\NetworkLogModel();
    $data['logs'] = $logModel->orderBy('id', 'DESC')->findAll();

    return view('admin/view_logs', $data);
}

}
