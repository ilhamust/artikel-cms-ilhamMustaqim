<?php

namespace App\Models;

use CodeIgniter\Model;
class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['post_id', 'name', 'content', 'created_at', 'updated_at'];
    protected $useTimestamps = true; // Aktifkan `created_at` dan `updated_at`
}