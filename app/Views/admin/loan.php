<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loans List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="text-primary mb-4">💰 Loan Records</h3>
  <table class="table table-bordered table-striped shadow-sm">
    <thead class="table-primary text-center">
      <tr>
        <th>Loan ID</th>
        <th>User ID</th>
        <th>Loan Type</th>
        <th>Loan Plan</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($loans as $loan): ?>
        <tr>
          <td><?= esc($loan['loan_id']); ?></td>
          <td><?= esc($loan['user_id']); ?></td>
          <td><?= esc($loan['ltype_name']); ?></td>
          <td><?= esc($loan['lplan_month']); ?> months</td>
          <td>₱<?= number_format($loan['amount'], 2); ?></td>
          <td><span class="badge bg-warning text-dark"><?= esc($loan['status']); ?></span></td>
          <td><?= esc($loan['created_at']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
