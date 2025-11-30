<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard | Loan Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- 🔹 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Loan Management System</a>
    <div class="d-flex">
      <span class="text-white me-3 fw-semibold">Hello, <?= session()->get('username'); ?>!</span>
      <a href="<?= base_url('/') ?>" class="btn btn-outline-light btn-sm">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </div>
  </div>
</nav>

<!-- 🔹 Page Content -->
<div class="container mt-5">
  <h3 class="text-center text-primary mb-4">Available Loan Types & Plans</h3>

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <div class="row">
    <?php foreach($loanTypes as $loan): ?>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title text-primary"><?= esc($loan['ltype_name']); ?></h5>
            <p class="card-text text-muted"><?= esc($loan['ltype_desc']); ?></p>
            
            <hr>
            <h6 class="text-secondary">Available Loan Plans:</h6>
            <ul class="list-group mb-3">
              <?php foreach($loanPlans as $plan): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong><?= esc($plan['lplan_month']); ?> Months</strong><br>
                    <small>Interest: <?= esc($plan['lplan_interest']); ?>% | Penalty: <?= esc($plan['lplan_penalty']); ?>%</small>
                  </div>
                  <a href="<?= base_url('loanuser/applyLoan/'.$loan['ltype_id'].'?plan='.$plan['lplan_id']); ?>" 
                     class="btn btn-success btn-sm">
                    <i class="bi bi-cash-stack"></i> Apply
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>
