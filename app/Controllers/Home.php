<?php

namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
{
    $loanModel = new LoanModel();
    $userModel = new UserModel();
    $settingModel = new \App\Models\SettingModel(); // ✅ Add this line

    $mode = $settingModel->getMode(); // ✅ Add this line

    $activeLoans = $loanModel->where('status', 'Approved')->countAllResults();
    $borrowers = $loanModel->distinct()->select('user_id')->countAllResults();
    $totalLoans = $loanModel->selectSum('amount')->get()->getRow()->amount ?? 0;

    $db = \Config\Database::connect();
    $paymentsToday = $db->table('payment')
                        ->selectSum('pay_amount')
                        ->where('DATE(date_created)', date('Y-m-d'))
                        ->get()
                        ->getRow()
                        ->pay_amount ?? 0;

    $data = [
        'activeLoans' => $activeLoans,
        'borrowers' => $borrowers,
        'totalLoans' => $totalLoans,
        'paymentsToday' => $paymentsToday,
        'mode' => $mode // ✅ Pass it to the view
    ];

    return view('home', $data);
}

    public function toggleSystemMode()
{
    $settingModel = new \App\Models\SettingModel();
    $newMode = $settingModel->toggleMode();

    return redirect()->back()->with('success', "System switched to " . ucfirst($newMode) . " mode.");
}
public function viewLogs()
{
    $logModel = new \App\Models\NetworkLogModel();
    $data['logs'] = $logModel->orderBy('id', 'DESC')->findAll();

    return view('admin/view_logs', $data);
}


}
