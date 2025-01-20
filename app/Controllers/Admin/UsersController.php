<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; //Memanggil class basecontroler
use App\Models\UserModel;

class UsersController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // Cek apakah ada pencarian
        $search = $this->request->getGet('search');

        if ($search) {
            $users = $userModel->search($search);
        } else {
            $users = $userModel->findAll();
        }

        // Kirim data ke view
        return view('admin/content/users', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[admin,user,penulis]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        // Simpan data user
        $userModel = new \App\Models\UserModel();
        $userModel->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to(base_url('users'))->with('success', 'User berhasil ditambahkan');
    }
    public function update()
{
    $validation = \Config\Services::validation();

    // Validasi input
    $validation->setRules([
        'id'       => 'required|integer',
        'username' => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|max_length[100]',
        'role'     => 'required|in_list[admin,user,penulis]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->to('/users')->with('error', $validation->listErrors());
    }

    $id = $this->request->getPost('id');

    $data = [
        'username' => $this->request->getPost('username'),
        'email'    => $this->request->getPost('email'),
        'role'     => $this->request->getPost('role'),
    ];

    // Update password jika diisi
    if ($this->request->getPost('password')) {
        $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    }

    $userModel = new \App\Models\UserModel();
    $userModel->update($id, $data);

    return redirect()->to('/users')->with('success', 'User berhasil diperbarui');
}

}
