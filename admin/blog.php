<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
include_once '../server/dbcon.php';

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $postId = $_POST['postId'];
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$postId]);
}

// Handle search
$searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';
$query = "SELECT * FROM posts WHERE title LIKE ? ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute(['%' . $searchKeyword . '%']);
$posts = $stmt->fetchAll();
?>

<link rel="stylesheet" href="./assets/css/blog-list.css">
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog Posts</h1>
        <div class="d-flex">
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="bi bi-search me-1"></i> Search
            </button>
            <a href="add_post.php" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Add New Post
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table custom-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><img src="<?= $post['image_url'] ?>" alt="Post Image" style="width: 100px; height: 100px; object-fit: cover;"></td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['created_at'] ?></td>
                            <td>
                                <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $post['id'] ?>"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal<?= $post['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $post['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $post['id'] ?>">Delete Confirmation</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-dark text-white">
                                        Are you sure you want to delete this post?
                                    </div>
                                    <div class="modal-footer bg-dark text-white">
                                        <form method="post">
                                            <input type="hidden" name="postId" value="<?= $post['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Pagination Logic Here -->
        </ul>
    </nav>
</div>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search Blog Posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="">
                    <div class="mb-3">
                        <label for="searchKeyword" class="form-label">Keyword</label>
                        <input type="text" class="form-control" id="searchKeyword" name="searchKeyword" placeholder="Enter keyword" value="<?= $searchKeyword ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once './includes/__footer__.php'; ?>