<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loan Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm p-4">
    <h4 class="text-primary mb-3">Loan Details</h4>

    <table class="table table-borderless">
      <tr><th>Borrower:</th><td><?= esc($loan['firstname'].' '.$loan['lastname']) ?></td></tr>
      <tr><th>Username:</th><td><?= esc($loan['username']) ?></td></tr>
      <tr><th>Loan Type:</th><td><?= esc($loan['ltype_name']) ?></td></tr>
      <tr><th>Description:</th><td><?= esc($loan['ltype_desc']) ?></td></tr>
      <tr><th>Loan Plan:</th>
        <td><?= esc($loan['lplan_month']) ?> months (Interest: <?= esc($loan['lplan_interest']) ?>%, Penalty: <?= esc($loan['lplan_penalty']) ?>%)</td>
      </tr>
      <tr><th>Amount:</th><td>₱<?= number_format($loan['amount'], 2) ?></td></tr>
      <tr><th>Status:</th><td><?= esc($loan['status']) ?></td></tr>
    </table>

    <form method="post" action="<?= base_url('loan/updateStatus/'.$loan['loan_id']) ?>">
      <div class="mb-3">
        <label class="form-label">Update Status</label>
        <select name="status" class="form-select">
          <option value="Pending" <?= $loan['status']=='Pending'?'selected':'' ?>>Pending</option>
          <option value="Approved" <?= $loan['status']=='Approved'?'selected':'' ?>>Approved</option>
          <option value="Rejected" <?= $loan['status']=='Rejected'?'selected':'' ?>>Rejected</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Save</button>
      <a href="<?= base_url('loans') ?>" class="btn btn-secondary">Back</a>
    </form>
  </div>
</div>
</body>
</html>
