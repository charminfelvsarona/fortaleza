<?php

namespace App\Controllers;

use App\Models\LoanTypeModel;
use App\Models\NetworkLogModel;

class LoanType extends BaseController
{
    protected $loanTypeModel;

    public function __construct()
    {
        $this->loanTypeModel = new LoanTypeModel();
        helper(['form', 'url']);
    }

    // Display all loan types
    public function index()
    {
        $data['loanTypes'] = $this->loanTypeModel->findAll();
        return view('loantype', $data); // 👈 matches app/Views/loantype.php
    }

    // Save a new loan type
    public function save()
{
    $this->loanTypeModel->insert([
        'ltype_name' => $this->request->getPost('ltype_name'),
        'ltype_desc' => $this->request->getPost('ltype_desc')
    ]);

    // 🧠 Log network activity
    $logModel = new NetworkLogModel();
    $logModel->logActivity('Added new Loan Type: ' . $this->request->getPost('ltype_name'));

    return redirect()->to(base_url('loan-type'))
                     ->with('success', 'Loan Type added successfully!');
}

public function update($id)
{
    $this->loanTypeModel->update($id, [
        'ltype_name' => $this->request->getPost('ltype_name'),
        'ltype_desc' => $this->request->getPost('ltype_desc')
    ]);

    // 🧠 Log network activity
    $logModel = new NetworkLogModel();
    $logModel->logActivity('Updated Loan Type ID: ' . $id);

    return redirect()->to(base_url('loan-type'))
                     ->with('success', 'Loan Type updated successfully!');

}
}