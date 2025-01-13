<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; //Memanggil class basecontroler
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index(): string
    {
        return view('admin/login');
    }
    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('user');
        $password = $this->request->getPost('password');

        // Cari user di database
        $user = $userModel->where('username', $username)->first();

        if ($password === $user['password']) { // Langsung dibandingkan
            // Simpan data user ke session
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'logged_in' => true,
            ]);
            return redirect()->to('/dashboard'); // Redirect ke dashboard
        } else {
            $session->setFlashdata('error', 'Password salah!');
        }

        return redirect()->back(); // Kembali ke halaman login
    }
    public function logout()
    {
        $session = session();

        // Hapus semua data session
        $session->destroy();

        // Redirect ke halaman login
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}