<?php
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
?>
<div class="container-fluid p-4 content-main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Server Information</h1>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card stat-card info">
                <div class="card-body">
                    <h5 class="card-title text-info">PHP Version</h5>
                    <p><?php echo phpversion(); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card stat-card primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">Server Software</h5>
                    <p><?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card stat-card warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">Server IP Address</h5>
                    <p><?php echo $_SERVER['SERVER_ADDR']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card stat-card success">
                <div class="card-body">
                    <h5 class="card-title text-success">Current Date/Time</h5>
                    <p><?php echo date('Y-m-d H:i:s'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once './includes/__footer__.php'; 