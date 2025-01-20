<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Categories;

class CategoriesController extends BaseController
{
    protected $categories;

    function __construct()
    {
        $this->categories = new Categories();
    }

    public function index()
    {
        // Ambil parameter pencarian
        $search = $this->request->getGet('search');
        $perPage = 5; // Jumlah item per halaman

        // Query data dengan pencarian
        $query = $this->categories;
        if (!empty($search)) {
            $query = $query->like('name', $search);
        }

        // Ambil data dengan pagination
        $data['categories'] = $query->paginate($perPage);
        $data['pager'] = $this->categories->pager; // Pager untuk navigasi pagination
        $data['search'] = $search;

        return view('admin/content/categories', $data);
    }



    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        if ($this->validate([
            'name' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
        ])) {
            // Proses upload gambar
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move('uploads/categories', $imageName);

            // Buat slug dari nama
            $name = $this->request->getPost('name');
            $slug = url_title($name, '-', true);

            // Insert data kategori
            $this->categories->insert([
                'name' => $name,
                'slug' => $slug,
                'image' => $imageName,
            ]);

            return redirect()->to('categories')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Jika validasi gagal
            return redirect()->to('categories')->with('error', $validation->getErrors());
        }
    }


    public function delete($id)
    {
        // Cari kategori berdasarkan ID
        $category = $this->categories->find($id);

        if ($category) {
            // Hapus gambar jika ada
            if (!empty($category['image']) && file_exists('uploads/categories/' . $category['image'])) {
                unlink('uploads/categories/' . $category['image']);
            }

            // Hapus data kategori
            $this->categories->delete($id);
            return redirect()->to('categories')->with('success', 'Data berhasil dihapus');
        }

        return redirect()->to('categories')->with('error', 'Data tidak ditemukan');
    }

    public function edit($id)
    {
        // Ambil data kategori berdasarkan ID
        $category = $this->categories->find($id);

        if (!$category) {
            return redirect()->to('categories')->with('error', 'Data tidak ditemukan');
        }

        return view('admin/content/edit_category', ['category' => $category]);
    }

    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        if ($this->validate([
            'name' => 'required',
            'image' => 'max_size[image,1024]|is_image[image]',
        ])) {
            $category = $this->categories->find($id);
            if (!$category) {
                return redirect()->to('categories')->with('error', 'Data tidak ditemukan');
            }

            // Jika gambar diunggah, proses upload gambar
            $image = $this->request->getFile('image');
            $imageName = $category['image']; // Gunakan gambar lama jika tidak ada upload baru
            if ($image && $image->isValid()) {
                $imageName = $image->getRandomName();
                $image->move('uploads/categories', $imageName);

                // Hapus gambar lama jika ada
                if (!empty($category['image']) && file_exists('uploads/categories/' . $category['image'])) {
                    unlink('uploads/categories/' . $category['image']);
                }
            }

            // Update data kategori
            $name = $this->request->getPost('name');
            $slug = url_title($name, '-', true);

            $this->categories->update($id, [
                'name' => $name,
                'slug' => $slug,
                'image' => $imageName,
            ]);

            return redirect()->to('categories')->with('success', 'Data berhasil diperbarui');
        } else {
            // Jika validasi gagal
            return redirect()->to("categories/edit/$id")->with('error', $validation->getErrors());
        }
    }

}
