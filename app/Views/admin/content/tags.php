<?= $this->extend('admin/index') ?>

<?php $this->section('styles') ?>
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Tags</h1>

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
                Tambah Tag
            </button>

            <form class="form-inline" action="<?= base_url('tags') ?>" method="get">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari tag" value="<?= isset($search) ? esc($search) : '' ?>" aria-label="Search">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Tag</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tags)) : ?>
                            <?php foreach ($tags as $tag) : ?>
                                <tr>
                                    <td><?= esc($tag['name']) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="showEditModal(<?= $tag['id'] ?>, '<?= esc($tag['name']) ?>')">Edit</button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deleteTag(<?= $tag['id'] ?>)">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3" style="padding-right: 15px;">
            <?= $pager->links('default', 'bootstrap_full') ?>
        </div>
    </div>
</div>

<!-- Modal Tambah Tag -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('tags') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tagName">Nama Tag</label>
                        <input type="text" id="tagName" name="name" class="form-control" placeholder="Masukkan nama tag" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Tag -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" action="" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTagName">Nama Tag</label>
                        <input type="text" id="editTagName" name="name" class="form-control" placeholder="Masukkan nama tag" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showEditModal(id, name) {
        $('#editModal').modal('show');
        $('#editForm').attr('action', '<?= base_url('tags') ?>/' + id); // Isi URL dengan ID tag
        $('#editTagName').val(name); // Isi input dengan nama tag
    }


    function deleteTag(id) {
        if (confirm('Apakah Anda yakin ingin menghapus tag ini?')) {
            window.location.href = '<?= base_url('tags/delete') ?>/' + id;
        }
    }
</script>

<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<?= $this->endSection() ?>