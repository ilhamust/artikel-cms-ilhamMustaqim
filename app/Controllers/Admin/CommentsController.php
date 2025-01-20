<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; //Memanggil class basecontroler
use App\Models\CommentModel;
use App\Models\Posts;

class CommentsController extends BaseController
{
    protected $commentModel;
    protected $postModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->postModel = new Posts(); // Pastikan Anda sudah membuat model untuk tabel posts
    }

    public function commentsByPost($postId)
    {
        // Ambil data post berdasarkan ID
        $post = $this->postModel->find($postId);

        if (!$post) {
            return redirect()->to('/posts')->with('error', 'Post tidak ditemukan.');
        }

        // Ambil komentar berdasarkan post_id
        $comments = $this->commentModel->where('post_id', $postId)->findAll();

        return view('admin/content/comments', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }
    public function delete($id)
    {
        // Cek apakah komentar dengan ID tersebut ada
        $comment = $this->commentModel->find($id);
        if (!$comment) {
            return redirect()->back()->with('error', 'Komentar tidak ditemukan.');
        }

        // Hapus komentar
        $this->commentModel->delete($id);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}