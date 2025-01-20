<?= $this->extend('admin/index') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Komentar pada Post: <?= esc($post['title']) ?></h1>
    </div>
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
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Card untuk Daftar Komentar -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Komentar</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($comments)) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="commentsTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Isi Komentar</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($comments as $comment) : ?>
                                        <tr>
                                            <td><?= esc($comment['name']) ?></td>
                                            <td><?= esc($comment['content']) ?></td>
                                            <td><?= esc($comment['created_at']) ?></td>
                                            <td>
                                                <a href="<?= base_url('comments/delete/' . $comment['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p>Tidak ada komentar untuk post ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#commentsTable').DataTable({
            paging: false, // Matikan pagination DataTables (karena sudah menggunakan CI pager)
            ordering: true,
            info: false,
        });
    });
</script>
<?= $this->endSection() ?>