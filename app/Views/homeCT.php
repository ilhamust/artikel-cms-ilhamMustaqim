<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Code Tutorial</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('styleCT') ?>/css/style.css">
</head>

<body>
  <!-- Navbar -->
  <?= $this->include('nav') ?>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="hero-title">Belajar Coding dengan Mudah</h1>
          <p class="hero-description">Tutorial pemrograman gratis dalam Bahasa Indonesia. Cocok untuk pemula yang ingin belajar coding dari dasar.</p>
          <a href="#tutorials" class="btn btn-primary btn-lg">Mulai Belajar</a>
        </div>
        <div class="col-md-6">
          <img src="<?= base_url('styleCT') ?>/img/coding.png" alt="Hero Image" class="img-fluid" style="height: 300px; margin-left: 250px;">
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <!-- Tutorial Section -->
      <div class="col-md-8">
        <h3 class="section-title">Artikel Tutorial</h3>
        <!-- Loop untuk menampilkan data dari database -->
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
          <p class="text-center">Belum ada artikel yang tersedia.</p>
        <?php endif; ?>
      </div>

      <!-- Kategori Section -->
      <div class="col-md-4">
        <h3 class="section-title">Kategori</h3>
        <?php if (!empty($categories) && is_array($categories)): ?>
          <?php foreach ($categories as $category): ?>
            <div class="category-item">
              <img src="<?= base_url('uploads/categories/' . $category['image']) ?>" alt="<?= esc($category['name']) ?>">
              <a href="<?= base_url('kategori/' . $category['slug']) ?>"><?= esc($category['name']) ?></a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-center">Tidak ada kategori tersedia.</p>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <?= $this->include('footer') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>