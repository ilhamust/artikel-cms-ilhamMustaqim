<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    // Tambahkan fungsi untuk pencarian user
    public function search($keyword)
    {
        return $this->like('username', $keyword)
                    ->orLike('email', $keyword)
                    ->findAll();
    }
}
