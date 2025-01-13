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
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="<?= base_url('styleCT') ?>/img/logo.png" alt="Logo" style="height: 50px; margin-right: 10px;">
        <span>CodeTutorial</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">HTML</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CSS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">JavaScript</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">PHP</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

 <!-- Banner -->
 <div class="d-flex justify-content-center my-4">
    <img src="<?= base_url('styleCT') ?>/img/banner.jpg" alt="Banner" class="img-fluid rounded">
  </div>

  <div class="container">
    <div class="row">
      <!-- Tutorial Section -->
      <div class="col-md-8">
        <h3>Artikel Tutorial</h3>
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?= base_url('styleCT') ?>/img/laravel-8.jpg" class="img-fluid rounded-start" alt="Laravel 8">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="artikel-laravel-8.html" class="text-decoration-none">Instalasi Laravel 8</a>
                </h5>
                <p class="card-text">Panduan untuk menginstal Laravel 8 secara lengkap.</p>
                <p class="text-muted">Jumat, 07 Mei 2021 | 0 Komentar</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?= base_url('styleCT') ?>/img/nuxt-js.jpg" class="img-fluid rounded-start" alt="Nuxt JS">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="artikel-nuxt-js.html" class="text-decoration-none">Belajar Nuxt JS</a>
                </h5>
                <p class="card-text">Tutorial mendalam mengenai Nuxt JS.</p>
                <p class="text-muted">Minggu, 02 Mei 2021 | 4 Komentar</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?= base_url('styleCT') ?>/img/laravel.jpg" class="img-fluid rounded-start" alt="Laravel">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="artikel-laravel.html" class="text-decoration-none">Belajar Laravel</a>
                </h5>
                <p class="card-text">Dasar-dasar Laravel untuk pemula.</p>
                <p class="text-muted">Minggu, 02 Mei 2021 | 0 Komentar</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Kategori Section -->
      <div class="col-md-4">
        <h3>Favorit</h3>
        <ul class="list-group">
          <li class="list-group-item">
            <a href="kategori-codeigniter.html" class="text-decoration-none">CodeIgniter</a>
          </li>
          <li class="list-group-item">
            <a href="kategori-javascript.html" class="text-decoration-none">JavaScript</a>
          </li>
          <li class="list-group-item">
            <a href="kategori-laravel.html" class="text-decoration-none">Laravel</a>
          </li>
          <li class="list-group-item">
            <a href="kategori-nuxt-js.html" class="text-decoration-none">Nuxt JS</a>
          </li>
          <li class="list-group-item">
            <a href="kategori-php.html" class="text-decoration-none">PHP</a>
          </li>
          <li class="list-group-item">
            <a href="kategori-python.html" class="text-decoration-none">Python</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container-fluid bg-light text-dark py-3">
    <div class="row">
      <!-- Logo dan Deskripsi -->
      <div class="col-md-3 mb-3">
        <img src="<?= base_url('styleCT') ?>/img/logo.png" alt="Logo Code Tutorial" class="mb-2" style="max-width: 100px;">
        <p class="mb-1" style="font-size: 0.8rem;">Kumpulan Tutorial Code yang mudah dipelajari.</p>
      </div>
  
      <!-- Tags -->
      <div class="col-md-4 mb-3">
        <h5 class="text-primary" style="font-size: 1rem;">Tags</h5>
        <div>
          <a href="#" class="badge bg-primary text-white text-decoration-none m-1" style="font-size: 0.8rem;">Symfony</a>
          <a href="#" class="badge bg-primary text-white text-decoration-none m-1" style="font-size: 0.8rem;">Rails</a>
          <a href="#" class="badge bg-primary text-white text-decoration-none m-1" style="font-size: 0.8rem;">Next JS</a>
          <a href="#" class="badge bg-primary text-white text-decoration-none m-1" style="font-size: 0.8rem;">React JS</a>
          <a href="#" class="badge bg-primary text-white text-decoration-none m-1" style="font-size: 0.8rem;">Node JS</a>
        </div>
      </div>
  
      <!-- Social Media -->
      <div class="col-md-3 mb-3">
        <h5 class="text-primary" style="font-size: 1rem;">Social Media</h5>
        <ul class="list-unstyled" style="font-size: 0.9rem;">
          <li><a href="https://www.github.com/ilhamust" class="text-dark text-decoration-none">Github</a></li>
          <li><a href="https://www.instagram.com/_ilhammustaqim" class="text-dark text-decoration-none">Instagram</a></li>
          <li><a href="https://www.linkedin.com/in/ilham-mustaqim-650806252/" class="text-dark text-decoration-none">LinkedIn</a></li>
        </ul>
      </div>
  
      <!-- About -->
      <div class="col-md-2 mb-3">
        <h5 class="text-primary" style="font-size: 1rem;">About</h5>
        <ul class="list-unstyled" style="font-size: 0.9rem;">
          <li><a href="#" class="text-dark text-decoration-none">About Us</a></li>
          <li><a href="#" class="text-dark text-decoration-none">Contact</a></li>
        </ul>
      </div>
    </div>
  
    <!-- Copyright -->
    <div class="text-center mt-2">
      <p class="mb-0 text-secondary" style="font-size: 0.85rem;">Copyright © 2025 Petani Kode. All Rights Reserved.</p>
    </div>
  </div>  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>