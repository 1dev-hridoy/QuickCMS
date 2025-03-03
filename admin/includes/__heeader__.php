<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/main.styl.css">
</head>
<body>
    <!-- Overlay for mobile sidebar -->
    <div class="overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="bi bi-lightning-charge-fill lightning"></i>Admin Panel</h3>
        </div>
        
        <div class="sidebar-heading">Core</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Pages</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-grid"></i>
                    <span>Posts</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Statistics</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart"></i>
                    <span>Charts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                <i class="bi bi-hdd-stack"></i>
                    <span>System</span>
                </a>
            </li>
        </ul>
    </div>