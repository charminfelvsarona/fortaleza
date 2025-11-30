<?php

namespace App\Controllers;

use App\Models\BorrowerModel;

class Borrower extends BaseController
{
    protected $borrowerModel;

    public function __construct()
    {
        $this->borrowerModel = new BorrowerModel();
        helper(['form', 'url']);
    }

    // Show borrower list
    public function index()
    {
        $data['borrowers'] = $this->borrowerModel->findAll();
        return view('borrower', $data);
    }

    // Save new borrower
    public function save()
    {
        $this->borrowerModel->insert([
            'firstname'   => $this->request->getPost('firstname'),
            'middlename'  => $this->request->getPost('middlename'),
            'lastname'    => $this->request->getPost('lastname'),
            'contact_no'  => $this->request->getPost('contact_no'),
            'address'     => $this->request->getPost('address'),
            'email'       => $this->request->getPost('email'),
            'tax_id'      => $this->request->getPost('tax_id'),
        ]);

        return redirect()->to(base_url('borrower'))->with('success', 'Borrower added successfully!');
    }

    // Update borrower
    public function update($id)
    {
        $this->borrowerModel->update($id, [
            'firstname'   => $this->request->getPost('firstname'),
            'middlename'  => $this->request->getPost('middlename'),
            'lastname'    => $this->request->getPost('lastname'),
            'contact_no'  => $this->request->getPost('contact_no'),
            'address'     => $this->request->getPost('address'),
            'email'       => $this->request->getPost('email'),
            'tax_id'      => $this->request->getPost('tax_id'),
        ]);

        return redirect()->to(base_url('borrower'))->with('success', 'Borrower updated successfully!');
    }

    // Delete borrower
    public function delete($id)
    {
        $this->borrowerModel->delete($id);
        return redirect()->to(base_url('borrower'))->with('success', 'Borrower deleted successfully!');
    }
}
