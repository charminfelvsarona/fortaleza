<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apply for a Loan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e3f2fd, #bbdefb);
      font-family: 'Poppins', sans-serif;
    }

    .loan-card {
      max-width: 550px;
      margin: 60px auto;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .loan-card-header {
      background: linear-gradient(135deg, #0d6efd, #007bff);
      color: white;
      padding: 25px 30px;
      text-align: center;
    }

    .loan-card-header h3 {
      margin: 0;
      font-weight: 600;
    }

    .loan-card-body {
      padding: 30px;
    }

    .form-label {
      font-weight: 500;
      color: #333;
    }

    .form-control, .form-select {
      border-radius: 10px;
      box-shadow: none;
      border: 1px solid #ced4da;
    }

    .btn-primary {
      background: linear-gradient(135deg, #007bff, #0d6efd);
      border: none;
      border-radius: 10px;
      font-weight: 500;
      padding: 12px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #0b5ed7, #084298);
      transform: translateY(-2px);
    }

    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="loan-card">
  <div class="loan-card-header">
    <h3>💳 Apply for a Loan</h3>
    <p class="mb-0 fs-6">Complete the form below to submit your loan request.</p>
  </div>

  <div class="loan-card-body">

    <?php if(session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger">
        <?= implode('<br>', session()->getFlashdata('errors')) ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('loanuser/saveApplication') ?>" method="post">
      <input type="hidden" name="loan_type_id" value="<?= esc($loanType['ltype_id']) ?>">

      <div class="mb-3">
        <label for="lplan_id" class="form-label">Select Loan Plan</label>
        <select name="loan_plan_id" id="lplan_id" class="form-select" required>
          <option value="">-- Choose a Loan Plan --</option>
          <?php foreach ($loanPlans as $plan): ?>
            <option value="<?= esc($plan['lplan_id']) ?>">
              <?= esc($plan['lplan_month']) ?> months (<?= esc($plan['lplan_interest']) ?>% interest)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="amount" class="form-label">Loan Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter desired amount" required>
      </div>

      <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
    </form>
  </div>
</div>

</body>
</html>
