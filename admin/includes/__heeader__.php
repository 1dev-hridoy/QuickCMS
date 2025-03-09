<?php
include_once '../server/dbcon.php';
include_once '__auth__check.php';

// Fetch existing settings data from the database
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize variables for title and description
$title = $settings['name'] ?? 'Dark Admin Dashboard';
$description = $settings['description'] ?? '';

// Get the current script name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($description) ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/main.styl.css">
    <link rel="stylesheet" href="./assets/css/main.page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Overlay for mobile sidebar -->
    <div class="overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 id="gradient-text"><i class="fa-solid fa-crown"></i> <?= htmlspecialchars($title) ?></h3>
        </div>
        
        <div class="sidebar-heading">Core</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>" href="./">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Pages</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'blog.php' ? 'active' : '' ?>" href="./blog.php">
                    <i class="bi bi-grid"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'carousel.php' ? 'active' : '' ?>" href="carousel.php">
                    <i class="bi bi-images"></i>
                    <span>Carousel</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Statistics</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'statistics.php' ? 'active' : '' ?>" href="./statistics.php">
                    <i class="bi bi-bar-chart"></i>
                    <span>Charts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'system.php' ? 'active' : '' ?>" href="./system.php">
                    <i class="bi bi-hdd-stack"></i>
                    <span>System</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Settings</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'settings.php' ? 'active' : '' ?>" href="./settings.php">
                    <i class="bi bi-gear"></i>
                    <span>SEO</span>
                </a>
            </li>
        </ul>
    </div>
</body>
</html>