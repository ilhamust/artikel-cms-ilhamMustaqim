<?= $this->extend('admin/index') ?>

<?php $this->section('styles') ?>
<!-- Custom styles for this page -->
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Categories</h1>

    <!-- Flash Message Placeholder -->
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

    <!-- Data Categories -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Tombol Tambah Kategori -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                Tambah Kategori
            </button>

            <!-- Form Pencarian -->
            <form class="form-inline" action="<?= base_url('categories') ?>" method="get">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari kategori" value="<?= isset($search) ? esc($search) : '' ?>" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)) : ?>
                            <?php foreach ($categories as $index => $category) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?php if (!empty($category['image'])) : ?>
                                            <img src="<?= base_url('uploads/categories/' . $category['image']) ?>" alt="Gambar Kategori" width="50">
                                        <?php else : ?>
                                            Tidak ada gambar
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($category['name']) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="showEditModal(<?= $category['id'] ?>, '<?= esc($category['name']) ?>', '<?= esc($category['image']) ?>')">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteCategory(<?= $category['id'] ?>)">Hapus</button>
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

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3" style="padding-right: 15px;">
            <?= $pager->links('default', 'bootstrap_full') ?>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('categories') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" class="form-control" id="image" required>
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

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="editCategoryForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Nama Kategori</label>
                        <input type="text" name="name" class="form-control" id="edit_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_image">Gambar</label>
                        <input type="file" name="image" class="form-control" id="edit_image">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?php $this->section('scripts') ?>
<script>
    function deleteCategory(id) {
        if (confirm('Yakin ingin menghapus?')) {
            window.location.href = `<?= base_url('categories/delete') ?>/${id}`;
        }
    }

    function showEditModal(id, name, image) {
        // Set form action
        const formAction = `<?= base_url('categories/update') ?>/${id}`;
        document.getElementById('editCategoryForm').action = formAction;

        // Set input values
        document.getElementById('edit_name').value = name;

        // Show modal
        $('#editModal').modal('show');
    }
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<?php $this->endSection() ?>