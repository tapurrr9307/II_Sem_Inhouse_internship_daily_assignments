<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "db_connect.php";

// Total vehicles query
$countQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM vehicles");
$totalVehicles = mysqli_fetch_assoc($countQuery)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet Management Dashboard</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(90deg, #198754, #20c997); /* Forest to Teal gradient */
        }

        .dashboard-title {
            font-weight: bold;
            color: #198754;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: .3s;
        }

        .table th {
            background: #198754;
            color: white;
        }

        footer {
            background: #212529;
            color: white;
        }

        /* Status badges */
        .badge-active {
            background: #198754;
            color: white;
        }

        .badge-maintenance {
            background: #dc3545;
            color: white;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            🚚 Fleet Control Center
        </a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                Welcome, <b><?= htmlspecialchars($_SESSION['user_name']) ?></b>
            </span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="dashboard-title">Fleet Overview</h2>
        <div class="text-muted">
            <?= date("d M Y | h:i A"); ?>
        </div>
    </div>

    <!-- Success Alert -->
    <div class="alert alert-success shadow-sm">
        ✅ <strong>System Connected!</strong> Loaded active log session for <b><?= htmlspecialchars($_SESSION['user_name']) ?></b>.
    </div>

    <!-- KPI Metric Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h1>🚛</h1>
                    <h5>Total Fleet Size</h5>
                    <h2 class="text-success"><?= $totalVehicles ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h1>👷‍♂️</h1>
                    <h5>Operator Role</h5>
                    <h2 class="text-dark">Dispatcher</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h1>📡</h1>
                    <h5>GPS Status</h5>
                    <h2 class="text-info">Online</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicle Inventory Table Data Control -->
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">📋 Vehicle Directory</h4>
        </div>
        <div class="card-body">

            <?php
            $vehicles = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY id DESC");

            if (mysqli_num_rows($vehicles) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Model Name</th>
                                <th>License Plate</th>
                                <th>Operational Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($vehicles)) {
                                // Dynamic CSS badge selection depending on database status value
                                $statusBadge = ($row['status'] === 'Active') ? 'badge-active' : 'badge-maintenance';
                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><b><?= htmlspecialchars($row['model']); ?></b></td>
                                    <td><code><?= htmlspecialchars($row['plate_number']); ?></code></td>
                                    <td>
                                        <span class="badge <?= $statusBadge; ?>">
                                            <?= htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-warning text-center">
                    No registered vehicles found in the fleet database.
                </div>
            <?php
            }
            ?>

        </div>
    </div>

</div>

<!-- Footer -->
<footer class="text-center py-3 mt-5">
    <div class="container">
        <p class="mb-1">© 2026 Fleet Management System Ltd.</p>
        <small>System Identity Address: <b><?= htmlspecialchars($_SESSION['user_email']); ?></b></small>
    </div>
</footer>

</body>
</html>
