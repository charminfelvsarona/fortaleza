<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'password', 'firstname', 'lastname', 'role'];
    protected $useTimestamps = false;

    /**
     * ✅ Get all users
     */
    public function getUsers()
    {
        return $this->findAll();
    }

    /**
     * ✅ Add new user
     */
    public function addUser(array $data)
    {
        // Automatically hash password before saving
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->insert($data);
    }

    /**
     * ✅ Update user info
     */
    public function updateUser($id, array $data)
    {
        // Re-hash password only if provided
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // Prevent overwriting with empty
        }

        return $this->update($id, $data);
    }

    /**
     * ✅ Delete user
     */
    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    /**
     * ✅ Verify user login credentials
     */
    public function verifyLogin($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Correct credentials
        }

        return false; // Invalid credentials
    }

    /**
     * ✅ Get user's full name
     */
    public function getFullName($user_id)
    {
        $user = $this->find($user_id);
        return $user ? trim($user['firstname'] . ' ' . $user['lastname']) : '';
    }

    /**
     * ✅ Check if user is admin
     */
    public function isAdmin($user_id)
    {
        $user = $this->find($user_id);
        return $user && $user['role'] === 'admin';
    }

    /**
     * ✅ Check if user is borrower
     */
    public function isUser($user_id)
    {
        $user = $this->find($user_id);
        return $user && $user['role'] === 'user';
    }
    
}
