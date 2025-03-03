<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Statistics Dashboard</h1>
        <a href="#" class="btn btn-primary btn-report">
            <i class="bi bi-download me-2"></i> Generate Report
        </a>
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
        <div class="chart-wrapper">
            <div class="chart-legend">
                <span class="legend-item post-visitors">
                    <span class="legend-color"></span>
                    Post Visitors
                </span>
            </div>
            <canvas id="postVisitorChart"></canvas>
        </div>
    </div>
</div>

<style>
/* Custom Dashboard Styling */
:root {
    --chart-site-visitors: #ff6384;
    --chart-post-visitors: #36a2eb;
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

.btn-report {
    background-color: #4e73df;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-radius: 0.25rem;
    display: flex;
    align-items: center;
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
    grid-template-columns: 1fr 1fr;
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

.post-visitors .legend-color {
    background-color: var(--chart-post-visitors);
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
        const ctxPostVisitor = document.getElementById('postVisitorChart').getContext('2d');
        
        // Set Chart.js defaults for dark theme
        Chart.defaults.color = '#adb5bd';
        Chart.defaults.scale.grid.color = 'rgba(255, 255, 255, 0.05)';
        Chart.defaults.scale.grid.zeroLineColor = 'rgba(255, 255, 255, 0.1)';
        
        // Dummy data for demonstration
        let siteVisitorData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Site Visitors',
                data: [100, 150, 200, 250, 300, 350],
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

        let postVisitorData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Post Visitors',
                data: [20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
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

        let postVisitorChart = new Chart(ctxPostVisitor, {
            type: 'line',
            data: postVisitorData,
            options: chartOptions
        });

        // Filter functionality
        document.getElementById('filterSelect').addEventListener('change', function(e) {
            const filterValue = e.target.value;
            // Update chart data based on filter selection
            if (filterValue === 'day') {
                siteVisitorData.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                siteVisitorData.datasets[0].data = [50, 60, 70, 80, 90, 100];
                postVisitorData.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                postVisitorData.datasets[0].data = [5, 6, 7, 8, 9, 10];
            } else if (filterValue === 'week') {
                siteVisitorData.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'];
                siteVisitorData.datasets[0].data = [200, 250, 300, 350, 400, 450];
                postVisitorData.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'];
                postVisitorData.datasets[0].data = [20, 25, 30, 35, 40, 45];
            } else if (filterValue === 'month') {
                siteVisitorData.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                siteVisitorData.datasets[0].data = [100, 150, 200, 250, 300, 350];
                postVisitorData.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                postVisitorData.datasets[0].data = [20, 30, 40, 50, 60, 70];
            }

            siteVisitorChart.update();
            postVisitorChart.update();
        });

        document.getElementById('chartTypeSelect').addEventListener('change', function(e) {
            const chartType = e.target.value;
            if (chartType === 'bar') {
                siteVisitorChart.config.type = 'bar';
                postVisitorChart.config.type = 'bar';
            } else if (chartType === 'line') {
                siteVisitorChart.config.type = 'line';
                postVisitorChart.config.type = 'line';
            }

            siteVisitorChart.update();
            postVisitorChart.update();
        });

        // Date range functionality
        document.getElementById('startDate').addEventListener('change', function(e) {
            console.log('Start Date:', e.target.value);
            // Implement logic to update charts based on start date
        });

        document.getElementById('endDate').addEventListener('change', function(e) {
            console.log('End Date:', e.target.value);
            // Implement logic to update charts based on end date
        });
        
        // Set default chart type to line
        document.getElementById('chartTypeSelect').value = 'line';
        
        // Ensure charts resize properly when window is resized
        window.addEventListener('resize', function() {
            siteVisitorChart.resize();
            postVisitorChart.resize();
        });
    });
</script>
<?php include_once './includes/__footer__.php'; ?>

