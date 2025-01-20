<?= $this->extend('admin/index') ?>

<?= $this->section('content') ?>

<div class="container p-4 bg-light shadow rounded">
    <h2 class="mb-4">Tambah Post</h2>

    <form action="/posts/store" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group mb-3">
            <label for="title">Judul</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= old('title') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="content">Konten</label>
            <textarea id="editor" name="content" class="form-control"><?= old('content') ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="tags">Tags</label>
            <select id="tags" name="tags[]" class="form-control" multiple>
                <?php foreach ($tags as $tag): ?>
                    <option value="<?= $tag['id'] ?>" <?= in_array($tag['id'], old('tags', [])) ? 'selected' : '' ?>>
                        <?= $tag['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form-group mb-3">
            <label for="image">Gambar Pembuka</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="description">Deskripsi Singkat</label>
            <input type="text" id="description" name="description" class="form-control" value="<?= old('description') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>

        <!-- Tombol Batal -->
        <a href="/posts" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $("#tags").select2({
            placeholder: "Pilih atau tambahkan tag",
            tags: true, // Membolehkan penambahan tag baru
            tokenSeparators: [',', ' '], // Pemisah untuk tag baru
        });
        
        const editorElement = document.querySelector("#editor");

        if (editorElement) {
            ClassicEditor.create(editorElement, {
                    toolbar: [
                        "heading",
                        "|",
                        "bold",
                        "italic",
                        "underline",
                        "strikethrough",
                        "|",
                        "link",
                        "imageUpload",
                        "mediaEmbed",
                        "blockQuote",
                        "|",
                        "numberedList",
                        "bulletedList",
                        "|",
                        "alignment",
                        "indent",
                        "outdent",
                        "|",
                        "undo",
                        "redo",
                    ],
                    ckfinder: {
                        uploadUrl: "/posts/upload_image", // Endpoint untuk upload gambar
                    },
                })
                .then((editor) => {
                    editor.ui.view.editable.element.style.height = "300px"; // Atur tinggi editor

                    // Sinkronisasi konten editor ke textarea saat submit form
                    const form = document.querySelector("form");
                    form.addEventListener("submit", () => {
                        const textarea = document.querySelector("#editor");
                        textarea.value = editor.getData();
                    });
                })
                .catch((error) => {
                    console.error("CKEditor tidak dapat dimuat:", error);
                });
        } else {
            console.error("Textarea dengan ID #editor tidak ditemukan!");
        }
    });
</script>
<?= $this->endSection() ?>