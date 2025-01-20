<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; //Memanggil class basecontroler
use App\Models\Categories;
use App\Models\UserModel;
use App\Models\Posts;
use App\Models\CommentModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $categoryModel = new Categories();
        $postModel = new Posts();
        $commentModel = new CommentModel();

        // Ambil jumlah data dari masing-masing tabel
        $data = [
            'totalUsers' => $userModel->countAllResults(),
            'totalCategories' => $categoryModel->countAllResults(),
            'totalPosts' => $postModel->countAllResults(),
            'totalComments' => $commentModel->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
    
}
