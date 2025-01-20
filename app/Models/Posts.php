<?php

namespace App\Models;

use CodeIgniter\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'slug', 'content', 'image', 'category_id', 'created_by', 'description'];

    /**
     * Mengambil artikel berdasarkan slug beserta data penulisnya.
     */
    public function getPostWithAuthor($slug)
    {
        return $this->select('posts.*, users.username AS author_name')
                    ->join('users', 'users.id = posts.created_by') // Join ke tabel users
                    ->where('posts.slug', $slug)
                    ->first();
    }

    /**
     * Mengambil komentar berdasarkan ID postingan.
     */
    public function getCommentsByPostId($postId)
    {
        return $this->db->table('comments')
                        ->where('post_id', $postId)
                        ->orderBy('created_at', 'DESC') // Urutkan berdasarkan waktu terbaru
                        ->get()
                        ->getResultArray();
    }
}
