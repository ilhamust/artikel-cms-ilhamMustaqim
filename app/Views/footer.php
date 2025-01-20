<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <img src="<?= base_url('styleCT') ?>/img/logo.png" alt="Logo Code Tutorial" class="mb-2" style="max-width: 100px;">
                <p class="mb-1">Kumpulan Tutorial Code yang mudah dipelajari.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Tags</h5>
                <div class="footer-tags">
                    <?php if (!empty($footerTags)) : ?>
                        <?php foreach ($footerTags as $tag) : ?>
                            <a href="#" class="badge text-decoration-none m-1"><?= esc($tag['name']) ?></a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-muted">Belum ada tag tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <h5>Social Media</h5>
                <ul class="list-unstyled social-links">
                    <li><a href="https://www.github.com/ilhamust">Github</a></li>
                    <li><a href="https://www.instagram.com/_ilhammustaqim">Instagram</a></li>
                    <li><a href="https://www.linkedin.com/in/ilham-mustaqim-650806252/">LinkedIn</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-3">
                <h5>About</h5>
                <ul class="list-unstyled social-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4">
            <p class="mb-0 text-secondary">Copyright © 2025 Ilham Mustaqim. All Rights Reserved.</p>
        </div>
    </div>
</footer>
