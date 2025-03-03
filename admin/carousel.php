<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
include_once '../server/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add new carousel item
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $imageName = uniqid() . '_' . basename($image['name']);
            $imagePath = $uploadDir . $imageName;
            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                $stmt = $pdo->prepare("INSERT INTO carousel (image_url, title, description) VALUES (?, ?, ?)");
                $stmt->execute([$imagePath, $title, $description]);
            } else {
                echo "Failed to move uploaded file.";
            }
        }
    } elseif (isset($_POST['edit'])) {
        // Edit carousel item
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $imageName = uniqid() . '_' . basename($image['name']);
            $imagePath = $uploadDir . $imageName;
            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                $stmt = $pdo->prepare("UPDATE carousel SET image_url = ?, title = ?, description = ? WHERE id = ?");
                $stmt->execute([$imagePath, $title, $description, $id]);
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            $stmt = $pdo->prepare("UPDATE carousel SET title = ?, description = ? WHERE id = ?");
            $stmt->execute([$title, $description, $id]);
        }
    } elseif (isset($_POST['delete'])) {
        // Delete carousel item
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM carousel WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$carouselItems = $pdo->query("SELECT * FROM carousel ORDER BY created_at DESC")->fetchAll();
?>

<link rel="stylesheet" href="./assets/css/carousel.css">
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h3 mb-0">Carousel Management</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarouselModal">
                            <i class="fas fa-plus me-2"></i>Add New
                        </button>
                    </div>
                    
                    <div class="carousel-items-list">
                        <?php foreach ($carouselItems as $item): ?>
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= $item['image_url'] ?>" class="img-fluid rounded-start" alt="Carousel Image" style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item['title'] ?></h5>
                                        <p class="card-text"><?= $item['description'] ?></p>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#editCarouselModal<?= $item['id'] ?>">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCarouselModal<?= $item['id'] ?>">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Carousel Modal -->
                        <div class="modal fade" id="editCarouselModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="editCarouselModalLabel<?= $item['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCarouselModalLabel<?= $item['id'] ?>">Edit Carousel Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Select Image</label>
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                                <img src="<?= $item['image_url'] ?>" class="img-fluid mt-2" style="width: 100%; height: 200px; object-fit: cover;">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="<?= $item['title'] ?>" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3" required><?= $item['description'] ?></textarea>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="edit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Carousel Modal -->
                        <div class="modal fade" id="deleteCarouselModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="deleteCarouselModalLabel<?= $item['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="deleteCarouselModalLabel<?= $item['id'] ?>">Delete Carousel Item</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-dark text-white">
                                        Are you sure you want to delete this carousel item?
                                    </div>
                                    <div class="modal-footer bg-dark text-white">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Carousel Modal -->
<div class="modal fade" id="addCarouselModal" tabindex="-1" aria-labelledby="addCarouselModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCarouselModalLabel">Add New Carousel Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once './includes/__footer__.php'; ?>