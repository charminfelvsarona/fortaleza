<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #0d6efd;
            color: white;
        }
        .sidebar a { color: white; text-decoration: none; }
        .sidebar a:hover { background-color: rgba(255,255,255,0.2); border-radius: 8px; }
        .dashboard-card { border-radius: 15px; }
        .nav-item { margin: 5px 0; }
        .user-info { margin-top: auto; }
        .toggle-btn {
            border-radius: 8px;
            transition: 0.3s;
        }
        .toggle-btn:hover {
            background-color: #ffc107;
            color: #000;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar d-flex flex-column p-3">
            <h3 class="text-center mb-4">ADMIN PANEL</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="<?= base_url('/home') ?>" class="nav-link text-white">🏠 Home</a></li>
                <li class="nav-item"><a href="<?= base_url('/loans') ?>" class="nav-link text-white">💰 Loans</a></li>
                <li class="nav-item"><a href="<?= base_url('/loan-plans') ?>" class="nav-link text-white">📄 Loan Plans</a></li>
                <li class="nav-item"><a href="<?= base_url('/loan-type') ?>" class="nav-link text-white">📊 Loan Types</a></li>
                <li class="nav-item"><a href="<?= base_url('user') ?>" class="nav-link text-white">🧑‍💼 Users</a></li>
                <li class="nav-item"><a href="<?= base_url('admin/view_logs') ?>" class="nav-link text-white">🧾 Activity Logs</a></li>
            </ul>

            <div class="user-info mt-auto pt-3 border-top">
                <div class="d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="40" class="me-2">
                    <div>
                        <strong>Administrator</strong><br>
                        <a href="<?= base_url('/') ?>" class="text-white small">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold">📊 Dashboard</h2>
                <form action="<?= base_url('admin/toggleMode') ?>" method="post" class="mb-0">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-warning btn-sm toggle-btn">
                        🛠️ Toggle System Mode
                    </button>
                </form>
            </div>

            <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>
<div class="alert <?= $mode === 'maintenance' ? 'alert-danger' : 'alert-success' ?>">
    System is currently <strong><?= ucfirst($mode) ?></strong>.
</div>


            <!-- Dashboard Stats -->
            <div class="row g-4 mt-3">
                <div class="col-md-3">
                    <div class="card shadow-sm dashboard-card text-center p-3">
                        <h5 class="text-muted">Active Loans</h5>
                        <h3 class="fw-bold text-primary"><?= $activeLoans ?? 0 ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm dashboard-card text-center p-3">
                        <h5 class="text-muted">Payments Today</h5>
                        <h3 class="fw-bold text-success">₱<?= number_format($paymentsToday ?? 0, 2) ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm dashboard-card text-center p-3">
                        <h5 class="text-muted">Borrowers</h5>
                        <h3 class="fw-bold text-info"><?= $borrowers ?? 0 ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm dashboard-card text-center p-3">
                        <h5 class="text-muted">Total Loans</h5>
                        <h3 class="fw-bold text-danger">₱<?= number_format($totalLoans ?? 0, 2) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
