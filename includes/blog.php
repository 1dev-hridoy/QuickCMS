<?php
include_once './server/dbcon.php';

// Fetch blog posts from the database
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>
 <style>
    .custom-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1000;
    overflow-y: auto;
}

.modal-content {
    position: relative;
    /* background-color: #fff; */
    margin: 5% auto;
    padding: 20px;
    width: 80%;
    max-width: 800px;
    border-radius: 5px;
    max-height: 90vh;
    overflow-y: auto;
    transform: translateY(50%);
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    z-index: 1001;
}
 </style>
<!-- Blog Posts -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php foreach ($posts as $post): ?>
                <!-- Blog Post -->
                <article class="blog-post" data-post-id="<?= $post['id'] ?>">
                    <div class="blog-image-wrapper">
                        <img src="<?= str_replace('../', './', $post['image_url']) ?>" class="blog-image" alt="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                    <div class="blog-content">
                        <a href="javascript:void(0);" class="post-title"><?= htmlspecialchars($post['title']) ?></a>
                        <p class="post-description">
                            <?php
                            $content = htmlspecialchars_decode($post['content']);
                            // Remove images from the content for the post list description
                            $description = preg_replace('/<img[^>]+>/', '', $content);
                            echo strip_tags($description);
                            ?>
                        </p>
                        <div class="post-meta">
                            <div class="meta-item">
                                <i class="bi bi-clock"></i>
                                <span><?= date('F j, Y', strtotime($post['created_at'])) ?></span>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Post Modal -->
<div class="custom-modal" id="postModal">
    <div class="modal-content">
        <button type="button" class="modal-close" id="modalClose">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="modal-body">
            <img src="/placeholder.svg" alt="" class="modal-image" id="modalImage">
            <h2 class="modal-title" id="modalTitle"></h2>
            <div class="modal-description" id="modalDescription"></div>
        </div>
    </div>
</div>

<script>
    // Store all posts data for easy access
    const postsData = <?= json_encode($posts) ?>;
    
    // Add click event to all blog posts
    document.querySelectorAll('.blog-post').forEach(post => {
        post.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const postData = postsData.find(p => p.id == postId);
            
            if (postData) {
                openModal(postData);
            }
        });
    });

    function openModal(post) {
        const modal = document.getElementById('postModal');
        document.getElementById('modalImage').src = post.image_url.replace('../', './');
        document.getElementById('modalTitle').textContent = post.title;
        document.getElementById('modalDescription').innerHTML = post.content;
        
        // Show modal and disable body scrolling
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('postModal');
        modal.style.display = 'none';
        
        // Re-enable body scrolling
        document.body.style.overflow = '';
    }

    // Close modal when clicking the close button
    document.getElementById('modalClose').addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeModal();
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('postModal');
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
</script>