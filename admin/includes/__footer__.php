<?php
include_once '../server/dbcon.php';

// Fetch existing settings data from the database
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize variable for title
$title = $settings['name'] ?? 'Your Website';
?>
 <!-- Footer -->
        <footer>
            <div class="container">
                <span>Copyright &copy; <?= htmlspecialchars($title) ?> <?= date('Y') ?></span>
            </div>
        </footer>
    </div>


    </div>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="../assets/js/chart.js"></script>
<script>
           // Toggle sidebar on mobile
           document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    });
    
    // Close sidebar when clicking on overlay
    document.getElementById('sidebarOverlay').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').classList.remove('show');
    });
    
    // Mobile menu toggle
    document.getElementById('mobileMenuToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    });
    
    // Area Chart
    const ctx = document.getElementById('myAreaChart').getContext('2d');
    const myAreaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Earnings',
                lineTension: 0.3,
                backgroundColor: 'rgba(58, 86, 228, 0.05)',
                borderColor: 'rgba(58, 86, 228, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(58, 86, 228, 1)',
                pointBorderColor: 'rgba(58, 86, 228, 1)',
                pointHoverRadius: 3,
                pointHoverBackgroundColor: 'rgba(58, 86, 228, 1)',
                pointHoverBorderColor: 'rgba(58, 86, 228, 1)',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
            }],
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                        color: '#333333'
                    },
                    ticks: {
                        maxTicksLimit: 7,
                        color: '#b0b0b0'
                    }
                },
                y: {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        color: '#b0b0b0',
                        callback: function(value) {
                            return '$' + value;
                        }
                    },
                    grid: {
                        color: '#333333',
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                },
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "#1e1e1e",
                    bodyColor: "#b0b0b0",
                    titleMarginBottom: 10,
                    titleColor: '#ffffff',
                    titleFontSize: 14,
                    borderColor: '#333333',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += '$' + context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
    
    // Pie Chart
    const ctxPie = document.getElementById('myPieChart').getContext('2d');
    const myPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Direct', 'Social', 'Referral'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#3a56e4', '#28a745', '#17a2b8'],
                hoverBackgroundColor: ['#2a46d4', '#218838', '#138496'],
                hoverBorderColor: '#1e1e1e',
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "#1e1e1e",
                    bodyColor: "#b0b0b0",
                    borderColor: '#333333',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                }
            },
            cutout: '70%',
        },
    });
</script>
</body>
</html>