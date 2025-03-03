<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
?>
<link rel="stylesheet" href="./assets/css/blog-list.css">
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog Posts</h1>
        <div class="d-flex">
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="bi bi-search me-1"></i> Search
            </button>
            <a href="#" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Add New Post
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover custom-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Dummy data - replace with actual database query
                        $posts = [
                            ['id' => 1, 'title' => 'Getting Started with PHP', 'author' => 'John Doe', 'category' => 'Programming', 'date' => '2023-06-15'],
                            ['id' => 2, 'title' => '10 SEO Tips for Beginners', 'author' => 'Jane Smith', 'category' => 'Digital Marketing', 'date' => '2023-06-14'],
                            ['id' => 3, 'title' => 'The Future of AI', 'author' => 'Mike Johnson', 'category' => 'Technology', 'date' => '2023-06-13'],
                            ['id' => 4, 'title' => 'Healthy Eating Habits', 'author' => 'Sarah Brown', 'category' => 'Health', 'date' => '2023-06-12'],
                            ['id' => 5, 'title' => 'Introduction to Machine Learning', 'author' => 'David Lee', 'category' => 'Data Science', 'date' => '2023-06-11'],
                        ];

                        foreach ($posts as $post) {
                            echo "<tr>";
                            echo "<td>{$post['title']}</td>";
                            echo "<td>{$post['author']}</td>";
                            echo "<td><span class='category-badge'>{$post['category']}</span></td>";
                            echo "<td>{$post['date']}</td>";
                            echo "<td>
                                    <a href='#' class='btn btn-sm btn-outline-primary me-1'><i class='bi bi-pencil'></i></a>
                                    <a href='#' class='btn btn-sm btn-outline-danger'><i class='bi bi-trash'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
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
                <form>
                    <div class="mb-3">
                        <label for="searchKeyword" class="form-label">Keyword</label>
                        <input type="text" class="form-control" id="searchKeyword" placeholder="Enter keyword">
                    </div>
                    <div class="mb-3">
                        <label for="searchCategory" class="form-label">Category</label>
                        <select class="form-select" id="searchCategory">
                            <option value="">All Categories</option>
                            <option value="programming">Programming</option>
                            <option value="digital-marketing">Digital Marketing</option>
                            <option value="technology">Technology</option>
                            <option value="health">Health</option>
                            <option value="data-science">Data Science</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="searchDateFrom" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="searchDateFrom">
                    </div>
                    <div class="mb-3">
                        <label for="searchDateTo" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="searchDateTo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</div>


<?php include_once './includes/__footer__.php'; ?>

