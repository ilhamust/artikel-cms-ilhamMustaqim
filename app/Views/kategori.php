<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori: <?= esc($category['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('styleCT') ?>/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <?= $this->include('nav') ?>
  <div class="container">
    <h1 class="my-4">Kategori: <?= esc($category['name']) ?></h1>
    <?php if (!empty($posts) && is_array($posts)): ?>
      <?php foreach ($posts as $post): ?>
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?= base_url('uploads/posts/' . $post['image']) ?>" alt="<?= esc($post['title']) ?>" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="<?= base_url('/detailArtikel/' . $post['slug']) ?>"><?= esc($post['title']) ?></a>
                </h5>
                <p class="card-text"><?= esc($post['description']) ?></p>
                <p class="text-muted"><?= date('l, d M Y', strtotime($post['updated_at'])) ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Tidak ada artikel dalam kategori ini.</p>
    <?php endif; ?>
  </div>
</body>
</html>
