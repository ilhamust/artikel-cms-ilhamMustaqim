<?php

namespace App\Models;

use CodeIgniter\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug'];
    protected $useTimestamps = true;

    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    // Fungsi untuk membuat slug sebelum data disimpan
    protected function generateSlug(array $data)
    {
        if (isset($data['data']['name'])) {
            $slug = url_title($data['data']['name'], '-', true);

            // Cek apakah slug sudah ada di database
            $existingSlug = $this->where('slug', $slug)->first();
            $count = 1;

            // Jika slug sudah ada, tambahkan angka di belakang slug
            while ($existingSlug) {
                $slug = url_title($data['data']['name'], '-', true) . '-' . $count;
                $existingSlug = $this->where('slug', $slug)->first();
                $count++;
            }

            $data['data']['slug'] = $slug;
        }
        return $data;
    }
    public function getTagsByPostId($postId)
    {
        return $this->db->table('tags')
            ->join('post_tags', 'tags.id = post_tags.tag_id')
            ->where('post_tags.post_id', $postId)
            ->get()
            ->getResultArray();
    }
}
