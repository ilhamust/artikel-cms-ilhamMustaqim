<?php

namespace App\Models;

use CodeIgniter\Model;
class PostTags extends Model
{
    protected $table = 'post_tags';
    protected $allowedFields = ['post_id', 'tag_id'];
}