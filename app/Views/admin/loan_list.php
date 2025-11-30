<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loan Applications | Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    .table thead th {
      vertical-align: middle;
    }
    .btn-back {
      background-color: #0d6efd;
      color: white;
      border-radius: 8px;
      padding: 6px 16px;
      transition: 0.2s;
    }
    .btn-back:hover {
      background-color: #0b5ed7;
      color: #fff;
    }
  </style>
</head>

<body class="bg-light">

<div class="container mt-5">
  
  <!-- Back Button -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary mb-0">Loan Applications</h3>
    <a href="<?= base_url('home') ?>" class="btn btn-back">← Back to Admin Panel</a>
  </div>

  <!-- Flash Messages -->
  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Loan Applications Table -->
  <div class="card p-4">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-primary text-center">
        <tr>
          <th>ID</th>
          <th>Borrower</th>
          <th>Loan Type</th>
          <th>Plan</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($loans as $loan): ?>
        <tr>
          <td><?= esc($loan['loan_id']) ?></td>
          <td><?= esc($loan['firstname'].' '.$loan['lastname']) ?></td>
          <td><?= esc($loan['ltype_name']) ?></td>
          <td><?= esc($loan['lplan_month']) ?> months</td>
          <td>₱<?= number_format($loan['amount'], 2) ?></td>
          <td class="text-center">
            <?php 
              $badge = match($loan['status']) {
                'Pending' => 'secondary',
                'Approved' => 'success',
                'Rejected' => 'danger',
                default => 'warning'
              };
            ?>
            <span class="badge bg-<?= $badge ?>"><?= esc($loan['status']) ?></span>
          </td>
          <td class="text-center">
            <form action="<?= base_url('loan/update-status/'.$loan['loan_id']) ?>" method="post" style="display:inline;">
              <input type="hidden" name="status" value="Approved">
              <button type="submit" class="btn btn-sm btn-success">Approve</button>
            </form>
            <form action="<?= base_url('loan/update-status/'.$loan['loan_id']) ?>" method="post" style="display:inline;">
              <input type="hidden" name="status" value="Rejected">
              <button type="submit" class="btn btn-sm btn-danger">Reject</button>
            </form>
            <form action="<?= base_url('loan/update-status/'.$loan['loan_id']) ?>" method="post" style="display:inline;">
              <input type="hidden" name="status" value="Pending">
              <button type="submit" class="btn btn-sm btn-secondary">Reset</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
