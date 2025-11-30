<?php

namespace App\Controllers;
use App\Models\LoanModel;
use App\Models\UserModel;
use App\Models\PaymentModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $loanModel = new LoanModel();
        $userModel = new UserModel();
        $paymentModel = new PaymentModel();

        $data['activeLoans'] = $loanModel->where('status', 'Active')->countAllResults();
        $data['borrowers'] = $userModel->countAllResults();
        $data['totalLoans'] = $loanModel->selectSum('amount')->get()->getRow()->amount ?? 0;
        $data['paymentsToday'] = $paymentModel->selectSum('amount')->where('DATE(created_at)', date('Y-m-d'))->get()->getRow()->amount ?? 0;

        return view('admin/dashboard', $data);
    }

    public function loans()
    {
        $loanModel = new LoanModel();

        $data['loans'] = $loanModel
            ->select('loans.*, loan_type.ltype_name, loan_plan.lplan_month')
            ->join('loan_type', 'loan_type.ltype_id = loans.ltype_id')
            ->join('loan_plan', 'loan_plan.lplan_id = loans.lplan_id')
            ->findAll();

         return view('/loans', $data); // ✅ correct view name
    }
    public function viewLogs()
{
    $logModel = new \App\Models\NetworkLogModel();
    $data['logs'] = $logModel->orderBy('id', 'DESC')->findAll();

    return view('admin/view_logs', $data);
}

}
