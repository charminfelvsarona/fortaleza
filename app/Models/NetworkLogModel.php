<?php

namespace App\Models;

use CodeIgniter\Model;

class NetworkLogModel extends Model
{
    protected $table = 'network_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'action', 'ip_address', 'mac_address', 'created_at'];

    public function logActivity($action)
    {
        $session = session();

        $userId = $session->get('user_id');
        $username = $session->get('username') ?? 'Unknown User';

        // Get IP address
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

        // ❌ exec() is blocked on hosting → remove it
        // ❌ $mac = exec('getmac');

        // ✅ SAFE fallback MAC address (hosting cannot fetch MAC)
        $mac = 'UNKNOWN_MAC';

        // Prefix username in action
        $formattedAction = "{$username} {$action}";

        // Insert into DB
        $this->insert([
            'user_id' => $userId,
            'action' => $formattedAction,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
