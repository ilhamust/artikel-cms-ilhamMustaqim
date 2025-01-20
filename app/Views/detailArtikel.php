<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel - CodeTutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('styleCT') ?>/css/styleDetailArtikel.css">
</head>

<body>
    <!-- Navbar -->
    <?= $this->include('nav') ?>

    <!-- Detail Artikel -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Article Container -->
                <div class="article-container">
                    <!-- Header Artikel -->
                    <div class="article-header">
                        <h1 class="article-title"><?= esc($post['title']) ?></h1>
                        <div class="article-meta">
                            <small>
                                <i class="bi bi-calendar-event"></i>
                                <?= date('l, d F Y', strtotime($post['created_at'])) ?> |
                                <i class="bi bi-person"></i> <?= esc($post['author_name']) ?>
                            </small>
                        </div>
                        <img src="<?= base_url('uploads/posts/' . $post['image']) ?>" alt="<?= esc($post['title']) ?>" class="img-fluid rounded mb-4">
                    </div>

                    <!-- Konten Artikel -->
                    <div class="article-content">
                        <?= $post['content'] ?>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="comments-section">
                    <h4 class="comments-title">Komentar</h4>
                    <div class="comment-list">
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <span class="comment-author"><?= esc($comment['name']) ?></span>
                                        <span class="comment-date"><?= date('d M Y', strtotime($comment['created_at'])) ?></span>
                                    </div>
                                    <p class="mb-0"><?= esc($comment['content']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Belum ada komentar.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Form Komentar -->
                    <div class="comment-form">
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <?= implode('<br>', session()->getFlashdata('errors')) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('detailArtikel/addComment/' . $post['id']) ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Tulis Komentar</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 70px;">
                    <div class="related-articles">
                        <h3>Artikel Terkait</h3>
                        <ul class="list-group">
                            <?php if (!empty($relatedPosts)): ?>
                                <?php foreach ($relatedPosts as $related): ?>
                                    <li class="list-group-item">
                                        <a href="<?= site_url('detailArtikel/' . $related['slug']) ?>">
                                            <?= esc($related['title']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">Tidak ada artikel terkait.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="article-tags">
                        <h5>Tags</h5>
                        <div>
                            <?php if (!empty($tags)): ?>
                                <?php foreach ($tags as $tag): ?>
                                    <a href="<?= base_url('tags/' . $tag['slug']) ?>" class="badge">
                                        <?= esc($tag['name']) ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Tidak ada tag terkait.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?= $this->include('footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
