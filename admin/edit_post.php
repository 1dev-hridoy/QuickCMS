<?php
// Start output buffering at the very beginning
ob_start();

include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
include_once '../server/dbcon.php';

$successMessage = '';
$postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($postId > 0) {
    // Fetch the post data
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$postId]);
    $post = $stmt->fetch();

    if (!$post) {
        // Post not found
        echo "<div class='alert alert-danger'>Post not found!</div>";
        exit;
    }
} else {
    // Post ID not provided
    echo "<div class='alert alert-danger'>Invalid post ID!</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['blogTitle'];
    $content = $_POST['content'];
    $image = $_FILES['blogImage'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $imageName = uniqid() . '_' . basename($image['name']);
        $imagePath = $uploadDir . $imageName;
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Update post with new image
            $stmt = $pdo->prepare("UPDATE posts SET image_url = ?, title = ?, content = ? WHERE id = ?");
            $stmt->execute([$imagePath, $title, $content, $postId]);
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        // Update post without changing image
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $postId]);
    }

    // Set success message
    $successMessage = 'Blog post updated successfully!';
    // Redirect to blog.php after successful update
    header("Location: ./blog.php");
    ob_end_flush(); // Flush the buffer before exit
    exit(); // Important to prevent further execution
}
?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form id="editBlogForm" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="blogTitle" class="form-label">Title</label>
                            <input type="text" class="form-control form-control-lg" id="blogTitle" name="blogTitle" value="<?= htmlspecialchars($post['title']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label for="blogImage" class="form-label">Featured Image</label>
                            <input type="file" class="form-control" id="blogImage" name="blogImage" accept="image/*" onchange="previewImage(event)">
                            <img id="imagePreview" src="<?= $post['image_url'] ?>" alt="Preview" class="img-preview mt-2" style="display: block;">
                        </div>
                        <div class="mb-4">
                            <label for="summernote" class="form-label">Content</label>
                            <textarea id="summernote" name="content"><?= htmlspecialchars($post['content']) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($successMessage): ?>
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?= $successMessage ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<?php endif; ?>

<style>
    :root {
        --primary-color: #4e73df;
        --primary-dark: #2e59d9;
        --secondary-color: #858796;
        --success-color: #1cc88a;
        --info-color: #36b9cc;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --dark-color: #5a5c69;
    }

    body {
        color: #5a5c69;
    }

    .container-fluid {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .card {
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid #d1d3e2;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .form-control-lg {
        font-size: 1.25rem;
    }

    .img-preview {
        max-width: 100%;
        max-height: 300px;
        border-radius: 0.5rem;
        object-fit: cover;
        object-position: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }

    .note-editor {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .note-toolbar {
        background-color: #f1f3f5;
    }

    .note-editing-area {
        background-color: #ffffff;
    }
</style>

<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Include jQuery and Summernote JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write your blog post here...',
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php 
include_once './includes/__footer__.php'; 
// Flush any remaining content
if (ob_get_length()) ob_end_flush();
?>