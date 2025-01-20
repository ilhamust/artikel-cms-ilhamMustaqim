<?php

namespace App\Controllers;

use App\Models\Posts;
use App\Models\Categories;
use App\Models\Tags;

class Home extends BaseController
{
    public function index()
    {
        $postsModel = new Posts();
        $categoriesModel = new Categories();
        $tagModel = new Tags();
        $data['footerTags'] = $tagModel->findAll(); // Ambil semua tag dari tabel tags
        // Ambil semua data posts, urutkan berdasarkan updated_at desc
        $data['posts'] = $postsModel->orderBy('updated_at', 'DESC')->findAll();

        // Ambil semua data categories
        $data['categories'] = $categoriesModel->findAll();

        return view('homeCT', $data);
    }
    public function kategori($slug)
{
    $categoriesModel = new Categories();
    $postsModel = new Posts();

    // Cari kategori berdasarkan slug
    $category = $categoriesModel->where('slug', $slug)->first();

    if (!$category) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kategori tidak ditemukan.");
    }

    // Ambil artikel yang terkait dengan kategori ini
    $data['posts'] = $postsModel->where('category_id', $category['id'])->findAll();
    $data['category'] = $category;

    return view('kategori', $data);
}

}
