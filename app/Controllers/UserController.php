<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['url', 'form']);
    }

    

    // View all users
    public function index()
    {
        $data['users'] = $this->userModel->getUsers();
        return view('user_view', $data);
    }

    // Add user
    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
            ];

            $this->userModel->addUser($data);
            return redirect()->to(base_url('user'))->with('success', 'User added successfully!');
        }
    }

    // Update user
    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
            ];

            $this->userModel->updateUser($id, $data);
            return redirect()->to(base_url('user'))->with('success', 'User updated successfully!');
        }
    }

    // Delete user
    public function delete($id)
    {
        $this->userModel->deleteUser($id);
        return redirect()->to(base_url('user'))->with('success', 'User deleted successfully!');
    }
}
