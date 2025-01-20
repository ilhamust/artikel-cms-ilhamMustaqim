<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPenulisToUserRole extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user', 'penulis'], // Tambahkan 'penulis'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user'], // Kembalikan ke nilai sebelumnya
            ],
        ]);
    }
}
