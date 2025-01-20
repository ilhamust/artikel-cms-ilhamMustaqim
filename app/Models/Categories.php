<?php

namespace App\Models;

use CodeIgniter\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['image', 'name', 'slug'];
    protected $beforeInsert = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (!isset($data['data']['slug']) && isset($data['data']['name'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        return $data;
    }
}
