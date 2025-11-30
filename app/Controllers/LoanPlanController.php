<?php

namespace App\Controllers;

use App\Models\LoanPlanModel;
use CodeIgniter\Controller;

class LoanPlanController extends Controller
{
    public function index()
    {
        $model = new LoanPlanModel();
        $data['loanPlans'] = $model->findAll();

        // load your existing Bootstrap + DataTables view
        return view('loan_plan', $data);
    }

    public function store()
    {
        $model = new LoanPlanModel();
        $data = [
            'lplan_month'    => $this->request->getPost('lplan_month'),
            'lplan_interest' => $this->request->getPost('lplan_interest'),
            'lplan_penalty'  => $this->request->getPost('lplan_penalty'),
        ];

        $model->insert($data);
        return redirect()->to('/loan-plans')->with('success', 'Loan plan added successfully.');
    }

    public function update($id)
    {
        $model = new LoanPlanModel();
        $data = [
            'lplan_month'    => $this->request->getPost('lplan_month'),
            'lplan_interest' => $this->request->getPost('lplan_interest'),
            'lplan_penalty'  => $this->request->getPost('lplan_penalty'),
        ];

        $model->update($id, $data);
        return redirect()->to('/loan-plans')->with('success', 'Loan plan updated successfully.');
    }

    public function delete($id)
    {
        $model = new LoanPlanModel();
        $model->delete($id);
        return redirect()->to('/loan-plans')->with('success', 'Loan plan deleted successfully.');
    }
}
