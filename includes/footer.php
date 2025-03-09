<footer>
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>About <?= htmlspecialchars($settings['name']) ?></h5>
                    <p><?= htmlspecialchars($settings['description']) ?></p>
                </div>
                <!-- Quick Links Section -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-decoration-none">Blog</a></li>
                        <li><a href="#" class="text-decoration-none">About</a></li>
                        <li><a href="#" class="text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <!-- Social Links Section -->
                <div class="col-md-4">
                    <h5>Connect With Us</h5>
                    <div class="social-links">
                        <?php if (!empty($settings['facebook'])): ?>
                            <a href="<?= htmlspecialchars($settings['facebook']) ?>"><i class="bi bi-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['twitter'])): ?>
                            <a href="<?= htmlspecialchars($settings['twitter']) ?>"><i class="bi bi-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['instagram'])): ?>
                            <a href="<?= htmlspecialchars($settings['instagram']) ?>"><i class="bi bi-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['linkedin'])): ?>
                            <a href="<?= htmlspecialchars($settings['linkedin']) ?>"><i class="bi bi-linkedin"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
    <script src="./assets/js/main.data.js"></script>
    <div class="custom-modal" id="postModal">
        <div class="modal-content">
            <button class="modal-close" id="modalClose">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="modal-body">
                <img src="/placeholder.svg" alt="" class="modal-image" id="modalImage">
                <h2 class="modal-title" id="modalTitle"></h2>
                <p class="modal-description" id="modalDescription"></p>
            </div>
        </div>
    </div>
</body>
</html>