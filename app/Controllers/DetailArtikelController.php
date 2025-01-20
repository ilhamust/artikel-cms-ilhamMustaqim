<?php

namespace App\Controllers;

use App\Models\Posts;
use App\Models\CommentModel;
use App\Models\Tags;

class DetailArtikelController extends BaseController
{
    public function index($slug)
    {
        $postsModel = new Posts();
        $commentModel = new CommentModel();
        $tagModel = new Tags();

        // Ambil data artikel berdasarkan slug
        $data['post'] = $postsModel->getPostWithAuthor($slug);

        if (!$data['post']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan.');
        }

        // Ambil komentar berdasarkan artikel
        $data['comments'] = $commentModel
            ->where('post_id', $data['post']['id'])
            ->orderBy('created_at', 'DESC')
            ->findAll();
         // Ambil tags terkait dengan artikel
         $data['tags'] = $tagModel->select('tags.*')
         ->join('post_tags', 'post_tags.tag_id = tags.id')
         ->where('post_tags.post_id', $data['post']['id'])
         ->findAll();
          // Ambil artikel terkait berdasarkan tags
        $relatedPosts = $postsModel->select('posts.*')
        ->join('post_tags', 'post_tags.post_id = posts.id')
        ->whereIn('post_tags.tag_id', array_column($data['tags'], 'id')) // Tags yang terkait
        ->where('posts.id !=', $data['post']['id']) // Exclude artikel yang sedang dibuka
        ->groupBy('posts.id')
        ->limit(5)
        ->findAll();

        $data['relatedPosts'] = $relatedPosts;
            // $post = $postsModel->where('slug', $slug)->first();
            // if (!$post) {
            //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // }

        // Ambil semua tag untuk footer
        $data['footerTags'] = $tagModel->findAll();

        return view('detailArtikel', $data);
    }

    public function addComment($postId)
    {
        $commentModel = new CommentModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'    => 'required|min_length[3]|max_length[100]',
            'comment' => 'required|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('errors', $validation->getErrors());
        }

        // Simpan data ke database
        $commentModel->save([
            'post_id' => $postId,
            'name'    => $this->request->getPost('name'),
            'content' => $this->request->getPost('comment'),
        ]);

        // Redirect kembali ke detail artikel
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
