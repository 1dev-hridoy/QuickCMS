<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
?>
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
                        <!-- Carousel Item 1 -->
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded-start" alt="Carousel Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Welcome to Our Website</h5>
                                        <p class="card-text">This is a sample carousel slide with some example text content to showcase the design.</p>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-sm btn-info me-2" onclick="editCarouselItem(1)">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteCarouselItem(1)">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Carousel Item 2 -->
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded-start" alt="Carousel Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Discover Our Services</h5>
                                        <p class="card-text">Learn more about the services we offer and how we can help you achieve your goals.</p>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-sm btn-info me-2" onclick="editCarouselItem(2)">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteCarouselItem(2)">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Carousel Item 3 -->
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded-start" alt="Carousel Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Join Our Community</h5>
                                        <p class="card-text">Become part of our growing community and stay updated with the latest news and events.</p>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-sm btn-info me-2" onclick="editCarouselItem(3)">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteCarouselItem(3)">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Carousel Modal -->
<div class="modal fade" id="addCarouselModal" tabindex="-1" aria-labelledby="addCarouselModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCarouselModalLabel">Add New Carousel Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="carouselForm" enctype="multipart/form-data">
                    <input type="hidden" id="carouselId" name="carouselId" value="">
                    
                    <div class="mb-3">
                        <label for="carouselImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="carouselImage" name="carouselImage" accept="image/*" onchange="previewCarouselImage(event)" required>
                    </div>
                    
                    <div class="mb-3">
                        <img id="carouselImagePreview" src="#" alt="Preview" class="img-preview">
                    </div>
                    
                    <div class="mb-3">
                        <label for="carouselTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="carouselTitle" name="carouselTitle" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="carouselDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="carouselDescription" name="carouselDescription" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveCarouselItem()">Save</button>
            </div>
        </div>
    </div>
</div>

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

    /* body {
        color: #5a5c69;
    } */

    .container-fluid {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .card {
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
        padding: 1.5rem;
    }

    .bg-gradient-primary {
        background: linear-gradient(87deg, var(--primary-color) 0, var(--primary-dark) 100%) !important;
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

    .img-preview {
        max-width: 100%;
        max-height: 300px;
        border-radius: 0.5rem;
        display: none;
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

    .btn-info {
        background-color: var(--info-color);
        border-color: var(--info-color);
        color: white;
    }

    .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .carousel-items-list .card {
        transition: all 0.3s ease;
    }

    .carousel-items-list .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    // Preview image when selected in the modal
    function previewCarouselImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('carouselImagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Save carousel item
    function saveCarouselItem() {
        var id = document.getElementById('carouselId').value;
        var title = document.getElementById('carouselTitle').value;
        var description = document.getElementById('carouselDescription').value;
        var imageInput = document.getElementById('carouselImage');
        
        console.log('Saving carousel item:');
        console.log('ID:', id ? id : 'New Item');
        console.log('Title:', title);
        console.log('Description:', description);
        console.log('Image selected:', imageInput.files.length > 0 ? imageInput.files[0].name : 'No image');
        
        // Here you would typically send the data to your server
        // For now, we'll just close the modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('addCarouselModal'));
        modal.hide();
        
        // Reset the form
        document.getElementById('carouselForm').reset();
        document.getElementById('carouselImagePreview').style.display = 'none';
    }

    // Edit carousel item
    function editCarouselItem(id) {
        // In a real application, you would fetch the item data from the server
        // For this example, we'll use hardcoded data
        var itemData = {
            id: id,
            title: 'Carousel Item ' + id,
            description: 'This is the description for carousel item ' + id
        };
        
        // Populate the form
        document.getElementById('carouselId').value = itemData.id;
        document.getElementById('carouselTitle').value = itemData.title;
        document.getElementById('carouselDescription').value = itemData.description;
        
        // Update modal title
        document.getElementById('addCarouselModalLabel').textContent = 'Edit Carousel Item';
        
        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('addCarouselModal'));
        modal.show();
    }

    // Delete carousel item
    function deleteCarouselItem(id) {
        if (confirm('Are you sure you want to delete this carousel item?')) {
            console.log('Deleting carousel item:', id);
            // Here you would typically send a delete request to your server
        }
    }

    // Reset modal when it's closed
    document.getElementById('addCarouselModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('carouselForm').reset();
        document.getElementById('carouselId').value = '';
        document.getElementById('carouselImagePreview').style.display = 'none';
        document.getElementById('addCarouselModalLabel').textContent = 'Add New Carousel Item';
    });
</script>

<?php include_once './includes/__footer__.php'; ?>

