<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
include_once '../server/dbcon.php';

// Initialize variables to prevent undefined variable warnings
$months = [];
$visitors = [];

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
foreach ($monthlyVisitorData as $data) {
    $months[] = $data['month'];
    $visitors[] = $data['monthly_visitors'];
}
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Statistics Dashboard</h1>
    </div>

    <!-- Advanced Filter Options -->
    <div class="filter-controls">
        <div class="filter-item">
            <select id="filterSelect" class="form-select">
                <option value="month">Month</option>
                <option value="week">Week</option>
                <option value="day">Day</option>
            </select>
        </div>
        <div class="filter-item">
            <select id="chartTypeSelect" class="form-select">
                <option value="line">Line Chart</option>
                <option value="bar">Bar Chart</option>
            </select>
        </div>
        <div class="filter-item">
            <input type="date" id="startDate" class="form-control" placeholder="Start Date">
        </div>
        <div class="filter-item">
            <input type="date" id="endDate" class="form-control" placeholder="End Date">
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-container">
        <div class="chart-wrapper">
            <div class="chart-legend">
                <span class="legend-item site-visitors">
                    <span class="legend-color"></span>
                    Site Visitors
                </span>
            </div>
            <canvas id="siteVisitorChart"></canvas>
        </div>
    </div>
</div>

<style>
/* Custom Dashboard Styling */
:root {
    --chart-site-visitors: #ff6384;
    --dashboard-bg: #121212;
    --card-bg: #1e1e1e;
    --text-color: #ffffff;
    --border-color: #333333;
    --input-bg: #2c2c2c;
}

body {
    background-color: var(--dashboard-bg);
    color: var(--text-color);
}

.dashboard-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.dashboard-title {
    font-size: 1.75rem;
    font-weight: 600;
    margin: 0;
    color: var(--text-color);
}

.filter-controls {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-item {
    flex: 1;
    min-width: 200px;
}

.form-select, .form-control {
    background-color: var(--input-bg);
    border: 1px solid var(--border-color);
    color: var(--text-color);
    border-radius: 0.25rem;
    padding: 0.5rem;
}

.form-select:focus, .form-control:focus {
    background-color: var(--input-bg);
    color: var(--text-color);
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
}

.charts-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

.chart-wrapper {
    background-color: var(--card-bg);
    border-radius: 0.5rem;
    padding: 1.5rem;
    box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
    position: relative;
    height: 400px; /* Add fixed height */
    display: flex;
    flex-direction: column;
}

.chart-legend {
    display: flex;
    margin-bottom: 1rem;
}

.legend-item {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    margin-right: 1.5rem;
}

.legend-color {
    display: inline-block;
    width: 1rem;
    height: 0.25rem;
    margin-right: 0.5rem;
}

.site-visitors .legend-color {
    background-color: var(--chart-site-visitors);
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .charts-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .filter-controls {
        flex-direction: column;
    }
    
    .filter-item {
        width: 100%;
    }
}

canvas {
    flex: 1;
    width: 100% !important;
    height: 100% !important;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxSiteVisitor = document.getElementById('siteVisitorChart').getContext('2d');

        // Set Chart.js defaults for dark theme
        Chart.defaults.color = '#adb5bd';
        Chart.defaults.scale.grid.color = 'rgba(255, 255, 255, 0.05)';
        Chart.defaults.scale.grid.zeroLineColor = 'rgba(255, 255, 255, 0.1)';

        let siteVisitorData = {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Site Visitors',
                data: <?= json_encode($visitors) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4
            }]
        };

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 4,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        padding: 10
                    },
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        padding: 10
                    },
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                }
            }
        };

        let siteVisitorChart = new Chart(ctxSiteVisitor, {
            type: 'line',
            data: siteVisitorData,
            options: chartOptions
        });

        // Filter functionality
        document.getElementById('filterSelect').addEventListener('change', function(e) {
            const filterValue = e.target.value;
            // Update chart data based on filter selection
            if (filterValue === 'day') {
                fetchVisitorData('day').then(data => updateChart(siteVisitorChart, data));
            } else if (filterValue === 'week') {
                fetchVisitorData('week').then(data => updateChart(siteVisitorChart, data));
            } else if (filterValue === 'month') {
                fetchVisitorData('month').then(data => updateChart(siteVisitorChart, data));
            }
        });

        document.getElementById('chartTypeSelect').addEventListener('change', function(e) {
            const chartType = e.target.value;
            siteVisitorChart.config.type = chartType;
            siteVisitorChart.update();
        });

        async function fetchVisitorData(filter) {
            const response = await fetch(`./dashboard.php?filter=${filter}`);
            return await response.json();
        }

        function updateChart(chart, data) {
            chart.data.labels = data.labels;
            chart.data.datasets[0].data = data.visitors;
            chart.update();
        }

        // Date range functionality
        document.getElementById('startDate').addEventListener('change', function(e) {
            fetchVisitorDataByDateRange().then(data => updateChart(siteVisitorChart, data));
        });

        document.getElementById('endDate').addEventListener('change', function(e) {
            fetchVisitorDataByDateRange().then(data => updateChart(siteVisitorChart, data));
        });

        async function fetchVisitorDataByDateRange() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const response = await fetch(`./dashboard.php?start_date=${startDate}&end_date=${endDate}`);
            return await response.json();
        }

        // Ensure charts resize properly when window is resized
        window.addEventListener('resize', function() {
            siteVisitorChart.resize();
        });
    });
</script>
<?php include_once './includes/__footer__.php'; ?>
