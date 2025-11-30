<?php

namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\LoanTypeModel;
use App\Models\LoanPlanModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\NetworkLogModel;

class LoanController extends Controller
{
    // ✅ Admin - View all loans
    public function index()
    {
        $loanModel = new LoanModel();
        $data['loans'] = $loanModel->getAllLoansWithDetails();

        return view('admin/loan_list', $data);
    }

    // ✅ Admin - View loan details
    public function view($id)
    {
        $loanModel = new LoanModel();
        $data['loan'] = $loanModel->getLoanById($id);

        if (!$data['loan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Loan not found');
        }

        return view('admin/loan_view', $data);
    }

    // ✅ User - Show loan application form
    public function applyForm()
    {
        $loanTypeModel = new LoanTypeModel();
        $loanPlanModel = new LoanPlanModel();

        $data['loan_types'] = $loanTypeModel->findAll();
        $data['loan_plans'] = $loanPlanModel->findAll();

        return view('loan_user/loan_apply', $data); // Create this view
    }

    // ✅ User - Apply for a loan
    public function applyLoan()
{
    helper(['form']);
    $validation = \Config\Services::validation();
    $validation->setRules([
        'loan_type_id' => 'required',
        'loan_plan_id' => 'required',
        'amount' => 'required|numeric|greater_than[0]'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $loanModel = new LoanModel();

    $data = [
        'user_id' => session()->get('user_id'),
        'loan_type_id' => $this->request->getPost('loan_type_id'),
        'loan_plan_id' => $this->request->getPost('loan_plan_id'),
        'amount' => $this->request->getPost('amount'),
        'status' => 'Pending',
        'created_at' => date('Y-m-d H:i:s')
    ];

    $loanModel->insert($data);

    // 🧠 Log network activity
    $logModel = new NetworkLogModel();
    $logModel->logActivity('Applied for Loan, Amount: ' . $this->request->getPost('amount'));

    return redirect()->to('/loan_user/dashboard')->with('success', 'Loan application submitted successfully!');
}

    // ✅ Admin - Approve a loan
    public function approve($id)
    {
        $loanModel = new LoanModel();

        $loan = $loanModel->find($id);
        if (!$loan) {
            return redirect()->back()->with('error', 'Loan not found!');
        }

        $loanModel->update($id, ['status' => 'Approved']);
        return redirect()->back()->with('success', 'Loan approved successfully!');
    }

    // ✅ Admin - Reject a loan
    public function reject($id)
    {
        $loanModel = new LoanModel();

        $loan = $loanModel->find($id);
        if (!$loan) {
            return redirect()->back()->with('error', 'Loan not found!');
        }

        $loanModel->update($id, ['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Loan rejected successfully!');
    }
    public function updateStatus($loan_id)
{
    $status = $this->request->getPost('status'); // ✅ Get from form input
    $loanModel = new LoanModel();

    $validStatuses = ['Pending', 'Approved', 'Rejected'];
    if (!in_array($status, $validStatuses)) {
        return redirect()->to('/loans')->with('error', 'Invalid status!');
    }

    $loanModel->update($loan_id, ['status' => $status]);

    // 🧠 Log admin activity (optional)
    $logModel = new NetworkLogModel();
    $logModel->logActivity('Updated loan #'.$loan_id.' status to '.$status);

    return redirect()->to('/loans')->with('success', 'Loan status updated to ' . $status . '!');
}



}
