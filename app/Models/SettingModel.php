<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['system_mode'];

    protected $logModel;

    public function __construct()
    {
        parent::__construct();
        $this->logModel = new NetworkLogModel(); // ✅ Initialize log model
    }

    public function getMode()
    {
        return $this->first()['system_mode'] ?? 'online';
    }

    public function toggleMode()
    {
        $current = $this->getMode();
        $newMode = ($current === 'online') ? 'maintenance' : 'online';

        $this->update(1, ['system_mode' => $newMode]);

        // ✅ Log the toggle action
        $this->logModel->logActivity("toggled system mode from {$current} to {$newMode}.");

        return $newMode;
    }

    public function setMode($mode)
    {
        $setting = $this->first();

        if ($setting) {
            $this->update($setting['id'], ['system_mode' => $mode]);
        } else {
            $this->insert(['system_mode' => $mode]);
        }

        // ✅ Log the manual mode set
        $this->logModel->logActivity("set the system mode to {$mode}.");
    }
}
