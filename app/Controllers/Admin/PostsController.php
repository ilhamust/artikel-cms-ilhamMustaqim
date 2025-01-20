<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\Tags;
use App\Models\Posts;
use App\Models\PostTags;

class PostsController extends BaseController
{
    protected $posts;

    public function __construct()
    {
        $this->posts = new Posts();
    }
    protected function generateUniqueSlug($title, $id = null)
    {
        $slug = url_title($title, '-', true); // Membuat slug dasar
        $postsModel = new \App\Models\Posts();

        $i = 0;
        $newSlug = $slug;
        while ($postsModel->where('slug', $newSlug)->where('id !=', $id)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i; // Tambahkan angka jika slug duplikat
        }

        return $newSlug;
    }

    // Fungsi untuk menampilkan halaman daftar posts dengan pagination
    public function index()
    {
        $search = $this->request->getGet('search'); // Ambil parameter pencarian
        $perPage = 5; // Jumlah item per halaman

        // Query data posts dengan join ke categories, users, dan hitung jumlah komentar
        $query = $this->posts->select('posts.*, categories.name as category, users.username as author, COUNT(DISTINCT comments.id) as comments')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->join('users', 'users.id = posts.created_by', 'left')
            ->join('comments', 'comments.post_id = posts.id', 'left')
            ->groupBy('posts.id'); // Pastikan setiap post di-group agar COUNT bekerja

        if (!empty($search)) {
            $query = $query->like('posts.title', $search);
        }

        // Ambil data dengan pagination
        $data['posts'] = $query->paginate($perPage);
        $data['pager'] = $this->posts->pager; // Pager untuk navigasi pagination
        $data['search'] = $search;

        return view('admin/content/posts', $data);
    }

    // Fungsi untuk menampilkan halaman tambah post
    public function create(): string
    {
        $categoriesModel = new Categories();
        $tagsModel = new Tags();

        $data = [
            'categories' => $categoriesModel->findAll(),
            'tags' => $tagsModel->findAll(),
        ];

        return view('admin/content/posts_create', $data);
    }

    // Fungsi untuk menyimpan data post baru
    public function store()
    {
        $postsModel = new Posts();
        $tagsModel = new Tags(); // Model untuk tabel tags
        $postTagsModel = new PostTags(); // Model untuk tabel perantara post_tags

        // Validasi input
        $validation = $this->validate([
            'title' => 'required|max_length[255]',
            'content' => 'required',
            'category_id' => 'required|integer',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload gambar
        $image = $this->request->getFile('image');

        if ($image && $image->isValid()) {
            $imageName = $image->getRandomName();

            // Simpan gambar ke folder public/uploads/posts
            $image->move(FCPATH . 'uploads/posts', $imageName);
        } else {
            $imageName = null; // Jika tidak ada gambar diunggah
        }

        // Simpan data ke tabel posts
        $postId = $postsModel->insert([
            'title' => $this->request->getPost('title'),
            'slug' => $this->generateUniqueSlug($this->request->getPost('title')),
            'content' => $this->request->getPost('content'),
            'description' => $this->request->getPost('description'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $imageName,
            'created_by' => session()->get('user_id'),
        ]);

        // Ambil data tags dari form
        $tags = $this->request->getPost('tags');

        if ($tags && is_array($tags)) {
            foreach (array_unique($tags) as $tag) {
                // Cek apakah tag berupa ID yang sudah ada atau string baru
                if (is_numeric($tag)) {
                    // Tag berupa ID yang sudah ada di database
                    $tagId = $tag;
                } else {
                    // Tag baru, tambahkan ke tabel tags
                    $existingTag = $tagsModel->where('name', $tag)->first();
                    if ($existingTag) {
                        $tagId = $existingTag['id']; // Gunakan ID tag yang sudah ada
                    } else {
                        $tagId = $tagsModel->insert(['name' => $tag]); // Tambahkan tag baru
                    }
                }

                // Masukkan ke tabel perantara (post_tags)
                $postTagsModel->insert([
                    'post_id' => $postId,
                    'tag_id' => $tagId,
                ]);
            }
        }


        return redirect()->to('/posts')->with('success', 'Post berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $categoriesModel = new Categories();
        $tagsModel = new Tags();
        $postTagsModel = new PostTags(); // Model untuk tabel perantara post_tags

        $post = $this->posts->find($id);

        if (!$post) {
            return redirect()->to('/posts')->with('error', 'Post tidak ditemukan.');
        }

        // Ambil daftar tag yang terhubung dengan post
        $selectedTags = $postTagsModel->where('post_id', $id)->findAll();
        $selectedTags = array_column($selectedTags, 'tag_id'); // Ambil hanya ID tags

        $data = [
            'post' => $post,
            'categories' => $categoriesModel->findAll(),
            'tags' => $tagsModel->findAll(),
            'selectedTags' => $selectedTags, // Kirim data tags terpilih ke view
        ];

        return view('admin/content/posts_edit', $data);
    }
    public function delete($id)
    {
        $post = $this->posts->find($id);

        if (!$post) {
            return redirect()->to('/posts')->with('error', 'Post tidak ditemukan.');
        }

        // Hapus gambar jika ada
        if (!empty($post['image']) && file_exists(FCPATH . 'uploads/posts/' . $post['image'])) {
            unlink(FCPATH . 'uploads/posts/' . $post['image']);
        }

        // Hapus data dari database
        $this->posts->delete($id);

        return redirect()->to('/posts')->with('success', 'Post berhasil dihapus.');
    }

    public function update($id)
    {
        $post = $this->posts->find($id);

        if (!$post) {
            return redirect()->to('/posts')->with('error', 'Post tidak ditemukan.');
        }

        // Validasi input
        $validation = $this->validate([
            'title' => 'required|max_length[255]',
            'content' => 'required',
            'category_id' => 'required|integer',
            'image' => 'if_exist|max_size[image,2048]|is_image[image]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update gambar jika ada file baru
        $imageName = $post['image'];
        $image = $this->request->getFile('image');

        if ($image && $image->isValid()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/posts', $imageName);

            // Hapus gambar lama
            if (!empty($post['image']) && file_exists(FCPATH . 'uploads/posts/' . $post['image'])) {
                unlink(FCPATH . 'uploads/posts/' . $post['image']);
            }
        }

        // Update data di database
        $this->posts->update($id, [
            'title' => $this->request->getPost('title'),
            'slug' => $this->generateUniqueSlug($this->request->getPost('title'), $id), // Perhatikan parameter $id
            'content' => $this->request->getPost('content'),
            'description' => $this->request->getPost('description'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $imageName,
        ]);

        $postTagsModel = new PostTags();
        $tagsModel = new Tags();

        // Ambil data tags dari form
        $tags = $this->request->getPost('tags');

        // Hapus semua tag lama terkait post
        $postTagsModel->where('post_id', $id)->delete();

        // Tambahkan tag baru
        if ($tags && is_array($tags)) {
            foreach (array_unique($tags) as $tag) {
                // Cek apakah tag berupa ID yang sudah ada atau string baru
                if (is_numeric($tag)) {
                    // Tag berupa ID yang sudah ada di database
                    $tagId = $tag;
                } else {
                    // Tag baru, tambahkan ke tabel tags
                    $existingTag = $tagsModel->where('name', $tag)->first();
                    if ($existingTag) {
                        $tagId = $existingTag['id']; // Gunakan ID tag yang sudah ada
                    } else {
                        $tagId = $tagsModel->insert(['name' => $tag]); // Tambahkan tag baru
                    }
                }

                // Masukkan ke tabel perantara (post_tags)
                $postTagsModel->insert([
                    'post_id' => $id,
                    'tag_id' => $tagId,
                ]);
            }
        }


        return redirect()->to('/posts')->with('success', 'Post berhasil diperbarui!');
    }
    public function upload_image()
    {
        $image = $this->request->getFile('upload');
        if (!$image->isValid()) {
            return $this->response->setJSON([
                'uploaded' => false,
                'error' => $image->getErrorString(),
            ]);
        }

        $fileName = $image->getRandomName();
        $image->move(FCPATH . 'uploads/posts/', $fileName);

        $url = base_url('uploads/posts/' . $fileName);

        return $this->response->setJSON([
            'uploaded' => true,
            'url' => $url,
        ]);
    }
}
