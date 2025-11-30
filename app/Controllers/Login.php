<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NetworkLogModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $logModel = new NetworkLogModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->verifyLogin($username, $password);

        if ($user) {
            $sessionData = [
                'user_id'   => $user['user_id'],
                'username'  => $user['username'],
                'logged_in' => true
            ];
            $session->set($sessionData);

            // ✅ Log successful login
            $logModel->logActivity('User logged in');

            return redirect()->to('/home');
        } else {
            // ❌ Log failed login attempt
            $logModel->logActivity('Failed login attempt for username: ' . $username);

            $session->setFlashdata('error', 'Invalid Username or Password');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $logModel = new NetworkLogModel();

        // ✅ Log logout activity
        if (session()->get('user_id')) {
            $logModel->logActivity('User logged out');
        }

        session()->destroy();
        return redirect()->to('/login');
    }
}
