<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Tags;

class TagsController extends BaseController
{
    protected $tagModel;

    public function __construct()
    {
        $this->tagModel = new Tags();
    }

    // Menampilkan daftar tag
    public function index()
    {
        // Ambil parameter pencarian
        $search = $this->request->getGet('search');
        $perPage = 5; // Jumlah item per halaman

        // Query data dengan pencarian
        $query = $this->tagModel;
        if (!empty($search)) {
            $query = $query->like('name', $search);
        }

        // Ambil data dengan pagination
        $data['tags'] = $query->paginate($perPage);
        $data['pager'] = $this->tagModel->pager; // Pager untuk navigasi pagination
        $data['search'] = $search;

        return view('admin/content/tags', $data);
    }

    // Tambah tag baru
    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        if ($this->validate([
            'name' => 'required|min_length[3]|max_length[100]|is_unique[tags.name]',
        ])) {
            // Buat slug dari nama
            $name = $this->request->getPost('name');
            $slug = url_title($name, '-', true);

            // Insert data tag
            $this->tagModel->insert([
                'name' => $name,
                'slug' => $slug,
            ]);

            return redirect()->to('/tags')->with('success', 'Tag berhasil ditambahkan.');
        } else {
            // Jika validasi gagal
            return redirect()->to('/tags')->with('error', $validation->getErrors());
        }
    }

    // Hapus tag
    public function delete($id)
    {
        // Cari tag berdasarkan ID
        $tag = $this->tagModel->find($id);

        if ($tag) {
            // Hapus data tag
            $this->tagModel->delete($id);
            return redirect()->to('/tags')->with('success', 'Tag berhasil dihapus.');
        }

        return redirect()->to('/tags')->with('error', 'Data tidak ditemukan.');
    }

    // Menampilkan halaman edit tag
    public function edit($id)
    {
        // Ambil data tag berdasarkan ID
        $tag = $this->tagModel->find($id);

        if (!$tag) {
            return redirect()->to('/tags')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/content/edit_tag', ['tag' => $tag]);
    }

    // Update data tag
    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        if ($this->validate([
            'name' => 'required|min_length[3]|max_length[100]|is_unique[tags.name,id,{id}]',
        ])) {
            $tag = $this->tagModel->find($id);
            if (!$tag) {
                return redirect()->to('/tags')->with('error', 'Data tidak ditemukan.');
            }

            // Buat slug dari nama
            $name = $this->request->getPost('name');
            $slug = url_title($name, '-', true);

            // Update data tag
            $this->tagModel->update($id, [
                'name' => $name,
                'slug' => $slug,
            ]);

            return redirect()->to('/tags')->with('success', 'Tag berhasil diperbarui.');
        } else {
            // Jika validasi gagal
            return redirect()->to("/tags/edit/$id")->with('error', $validation->getErrors());
        }
    }
}
