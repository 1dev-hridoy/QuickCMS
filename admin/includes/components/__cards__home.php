<?php
// Ensure no previous output before headers
ob_start();

include_once '../server/dbcon.php';

// Initialize variables to prevent undefined variable warnings
$totalVisitors = 0;
$monthlyVisitors = 0;
$yearlyVisitors = 0;
$totalPosts = 0;
$totalCarousel = 0;
$months = [];
$visitors = [];

// Get total posts count
$stmt = $pdo->query("SELECT COUNT(*) as total_posts FROM posts");
$totalPosts = $stmt->fetch()['total_posts'];

// Get total carousel count
$stmt = $pdo->query("SELECT COUNT(*) as total_carousel FROM carousel");
$totalCarousel = $stmt->fetch()['total_carousel'];

// Get monthly visitor data for chart
$stmt = $pdo->query("SELECT 
    DATE_FORMAT(date, '%Y-%m') as month, 
    COUNT(*) as monthly_visitors 
    FROM website_visitors 
    GROUP BY month 
    ORDER BY month DESC 
    LIMIT 12");
$monthlyVisitorData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for Chart.js
$months = [];
$visitors = [];
foreach ($monthlyVisitorData as $data) {
    $months[] = $data['month'];
    $visitors[] = $data['monthly_visitors'];
}

// Get all-time visitor count
$stmt = $pdo->query("SELECT COUNT(*) as total_visitors FROM website_visitors");
$totalVisitors = $stmt->fetch()['total_visitors'];

// Get monthly visitor count
$currentMonth = date('Y-m');
$stmt = $pdo->prepare("SELECT COUNT(*) as monthly_visitors FROM website_visitors WHERE DATE_FORMAT(date, '%Y-%m') = ?");
$stmt->execute([$currentMonth]);
$monthlyVisitors = $stmt->fetch()['monthly_visitors'];

// Get yearly visitor count
$currentYear = date('Y');
$stmt = $pdo->prepare("SELECT COUNT(*) as yearly_visitors FROM website_visitors WHERE DATE_FORMAT(date, '%Y') = ?");
$stmt->execute([$currentYear]);
$yearlyVisitors = $stmt->fetch()['yearly_visitors'];
?>

<!-- Dashboard -->
<div class="container-fluid p-4 content-main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
    </div>

    <!-- Date and Time Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">Current Date and Time</h6>
                        <div id="full-date-time" class="h5 mb-0 text-gray-800 mt-2"></div>
                    </div>
                    <div>
                        <h6 class="m-0 font-weight-bold text-success">Server Time Zone</h6>
                        <div class="h5 mb-0 text-gray-800 mt-2"><?= date_default_timezone_get() ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <!-- Visitor (Monthly) Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card primary h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-primary">Visitor (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $monthlyVisitors ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-eye stat-icon text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Post Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card success h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-success">Total Post</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalPosts ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box stat-icon text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alltime Visitor Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card info h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-info">Alltime Visitor</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalVisitors ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-check stat-icon text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Carousel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card warning h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-warning">Total Carousel</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalCarousel ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-images stat-icon text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings Overview (Visitor Chart) -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Visitors Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateFullDateTime() {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };
    document.getElementById('full-date-time').textContent = now.toLocaleString('en-US', options);
}

// Update date and time every second
setInterval(updateFullDateTime, 1000);
updateFullDateTime(); // Initial call

document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('visitorChart').getContext('2d');
    var visitorChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Monthly Visitors',
                data: <?= json_encode($visitors) ?>,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
<?php
// Flush the output buffer
ob_end_flush();
?>