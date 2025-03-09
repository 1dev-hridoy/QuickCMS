<?php
include_once '../server/dbcon.php';

// Fetch existing settings data from the database
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize variable for title
$title = $settings['name'] ?? '';
?>
<!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button id="sidebarToggle" class="navbar-toggler" type="button">
                    <i class="bi bi-list"></i>
                </button>
                <a id="gradient-text" class="navbar-brand" href="#"><i class="fa-solid fa-crown"></i> <?= htmlspecialchars($title) ?></a>
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="./settings.php"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>