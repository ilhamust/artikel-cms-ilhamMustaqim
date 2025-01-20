<?= $this->extend('admin/index') ?>

<?php $this->section('styles') ?>
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Posts</h1>

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
            <!-- Button Tambah Post -->
            <a href="<?= base_url('posts/create') ?>" class="btn btn-primary">Tambah Post</a>

            <!-- Form Pencarian -->
            <form class="form-inline" action="<?= base_url('posts') ?>" method="get">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari post" value="<?= isset($search) ? esc($search) : '' ?>" aria-label="Search">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Post</th>
                            <th>Category</th>
                            <th>Penulis</th>
                            <th>Komentar</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($posts)) : ?>
                            <?php foreach ($posts as $post) : ?>
                                <tr>
                                    <td><?= esc($post['title']) ?></td>
                                    <td><?= esc($post['category']) ?></td>
                                    <td><?= esc($post['author']) ?></td>
                                    <td>
                                        <!--  ikon komentar dapat diklik dan mengarah ke halaman komentar -->
                                        <a href="<?= base_url('comments/post/' . esc($post['id'])) ?>">
                                            <i class="fas fa-comment"></i> <?= esc($post['comments']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('posts/edit/' . $post['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('posts/delete/' . $post['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus post ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3" style="padding-right: 15px;">
            <?= $pager->links('default', 'bootstrap_full') ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            paging: false,
            ordering: true,
            info: false,
        });
    });
</script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<?= $this->endSection() ?>