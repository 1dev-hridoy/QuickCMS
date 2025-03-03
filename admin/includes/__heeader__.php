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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    #gradient-text {
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    margin-left: 3px;
    background: linear-gradient(
        to right,
        #ff0000, #ff3300, #ff6600, #ff9900, #ffcc00, #ffff00, #ff0000
    );
    background-size: 300% auto;
    color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
    animation: fireGradient 1.5s linear infinite, heatHaze 1.5s ease-in-out infinite;
    text-shadow: 0 0 20px rgba(255, 100, 0, 0.3);
    position: relative;
}

/* Fire-like gradient animation */
@keyframes fireGradient {
    0% { background-position: 0% center; }
    100% { background-position: 300% center; }
}


#gradient-text::after {
    top: 110%;
    width: 150%;
    height: 25px;
    filter: blur(25px);
    opacity: 0.5;
    animation-duration: 1s;
}

@keyframes flicker {
    0% { opacity: 0.5; transform: scaleX(0.95) translateY(2px); }
    25% { opacity: 0.65; }
    50% { opacity: 0.8; transform: scaleX(1.05) translateY(-2px); }
    75% { opacity: 0.7; }
    100% { opacity: 0.5; transform: scaleX(0.95) translateY(2px); }
}

@keyframes heatHaze {
    0% { transform: translateY(0) scaleX(1); }
    50% { transform: translateY(-2px) scaleX(1.02); }
    100% { transform: translateY(0) scaleX(1); }
}
</style>
<body>
    <!-- Overlay for mobile sidebar -->
    <div class="overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 id="gradient-text"><i class="fa-solid fa-crown"></i>  TestNet KING</h3>
        </div>
        
        <div class="sidebar-heading">Core</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="./">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Pages</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="./blog.php">
                    <i class="bi bi-grid"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="carousel.php">
                <i class="bi bi-images"></i>
                    <span>Carousel </span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-heading">Statistics</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="./statistics.php">
                    <i class="bi bi-bar-chart"></i>
                    <span>Charts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./system.php">
                <i class="bi bi-hdd-stack"></i>
                    <span>System</span>
                </a>
            </li>
        </ul>
    </div>