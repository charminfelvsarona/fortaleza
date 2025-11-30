<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LoanTypeModel;
use App\Models\LoanModel;
use App\Models\NetworkLogModel; // ✅ Add this
use CodeIgniter\Controller;

class LoanUserController extends Controller
{
    protected $logModel;

    public function __construct()
    {
        $this->logModel = new NetworkLogModel(); // ✅ Initialize log model
    }

    public function login()
    {
        return view('loan_user/login');
    }

    public function loginPost()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (
                password_verify($password, $user['password']) || 
                $user['password'] === $password
            ) {
                session()->set([
                    'user_id'   => $user['user_id'],
                    'username'  => $user['username'],
                    'logged_in' => true
                ]);

                // ✅ Log successful login
                $this->logModel->logActivity("has logged in successfully.");

                return redirect()->to('/loanuser/dashboard');
            }
        }

        // ❌ Log failed login attempt
        $this->logModel->logActivity("failed to log in (invalid credentials).");

        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    public function register()
    {
        return view('loan_user/register');
    }

    public function registerPost()
    {
        $model = new UserModel();

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->insert($data);

        // ✅ Log registration
        $this->logModel->logActivity("has registered a new account.");

        return redirect()->to('/loanuser/login')->with('success', 'Registration successful! You can now log in.');
    }

    public function dashboard()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/loanuser/login');
        }

        $loanTypeModel = new LoanTypeModel();
        $loanPlanModel = new \App\Models\LoanPlanModel();
        $data['loanTypes'] = $loanTypeModel->findAll();
        $data['loanPlans'] = $loanPlanModel->findAll();

        // ✅ Log dashboard access
        $this->logModel->logActivity("visited the dashboard.");

        return view('loan_user/dashboard', $data);
    }

    public function applyLoan($ltype_id)
    {
        $loanTypeModel = new LoanTypeModel();
        $loanPlanModel = new \App\Models\LoanPlanModel();

        $data['loanType'] = $loanTypeModel->find($ltype_id);
        $data['loanPlans'] = $loanPlanModel->findAll();

        // ✅ Log viewing of loan application form
        $this->logModel->logActivity("opened loan application form for Loan Type ID {$ltype_id}.");

        return view('loan_user/loan_apply', $data);
    }

    public function submitLoan()
    {
        $loanModel = new LoanModel();

        $data = [
            'user_id' => session()->get('user_id'),
            'ltype_id' => $this->request->getPost('ltype_id'),
            'lplan_id' => $this->request->getPost('lplan_id'),
            'amount' => $this->request->getPost('amount'),
            'status' => 'Pending'
        ];

        $loanModel->insert($data);

        // ✅ Log loan application submission
        $this->logModel->logActivity("submitted a loan application for ₱" . $data['amount']);

        return redirect()->to('loanuser/dashboard')->with('success', 'Loan application submitted successfully!');
    }

    public function saveApplication()
    {
        $loanModel = new LoanModel();

        $data = [
            'user_id'  => session()->get('user_id'),
            'ltype_id' => $this->request->getPost('loan_type_id'),
            'lplan_id' => $this->request->getPost('loan_plan_id'),
            'amount'   => $this->request->getPost('amount'),
            'status'   => 'Pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($loanModel->insert($data)) {

            // ✅ Log successful application
            $this->logModel->logActivity("successfully applied for a loan worth ₱" . $data['amount']);

            return redirect()->to(base_url('loanuser/dashboard'))
                ->with('success', 'Loan application submitted successfully!');
        } else {
            // ❌ Log failed attempt
            $this->logModel->logActivity("failed to apply for a loan.");

            return redirect()->back()->with('errors', ['Failed to apply for the loan.']);
        }
    }

    public function logout()
    {
        // ✅ Log before logout
        $this->logModel->logActivity("has logged out.");

        session()->destroy();
        return redirect()->to('/loanuser/login');
    }
}
