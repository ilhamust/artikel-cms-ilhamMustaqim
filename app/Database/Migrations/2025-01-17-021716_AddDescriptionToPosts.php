<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDescriptionToPosts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'description' => [
                'type'       => 'TEXT',
                'null'       => true, // Biarkan null agar tidak menyebabkan masalah pada data lama
                'after'      => 'content', // Letakkan setelah kolom 'content'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'description');
    }
}
