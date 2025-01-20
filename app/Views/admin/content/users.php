<?= $this->extend('admin/index') ?>

<?php $this->section('styles') ?>
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data User</h1>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                Tambah User
            </button>
            <form class="form-inline" action="<?= base_url('users') ?>" method="get">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari user" value="<?= isset($search) ? esc($search) : '' ?>" aria-label="Search">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['role']) ?></td>
                                    <td>
                                        <button
                                            class="btn btn-warning btn-sm btn-edit"
                                            data-id="<?= $user['id'] ?>"
                                            data-username="<?= esc($user['username']) ?>"
                                            data-email="<?= esc($user['email']) ?>"
                                            data-role="<?= esc($user['role']) ?>"
                                            data-toggle="modal"
                                            data-target="#editModal">
                                            Edit
                                        </button>
                                        <a href="<?= base_url('users/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-end mt-3" style="padding-right: 15px;">
            <!-- pager -->
        </div>
    </div>
</div>
<!-- Modal Tambah User -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('users/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="penulis">Penulis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit User -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('users/update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-username">Username</label>
                        <input type="text" name="username" id="edit-username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-role">Role</label>
                        <select name="role" id="edit-role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="penulis">Penulis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-password">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" id="edit-password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    $(document).on('click', '.btn-edit', function() {
        // Ambil data dari atribut tombol
        const id = $(this).data('id');
        const username = $(this).data('username');
        const email = $(this).data('email');
        const role = $(this).data('role');

        // Isi data ke dalam form modal
        $('#edit-id').val(id);
        $('#edit-username').val(username);
        $('#edit-email').val(email);
        $('#edit-role').val(role);

        // Kosongkan password (opsional)
        $('#edit-password').val('');
    });
</script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<?= $this->endSection() ?>