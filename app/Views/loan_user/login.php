<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loan User Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="card shadow p-4" style="width: 380px;">
    <h4 class="text-center text-primary mb-3">
      <i class="bi bi-person-circle"></i> Loan User Login
    </h4>

    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
    <?php elseif(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- ✅ Fixed form action -->
    <form action="<?= base_url('loanuser/loginPost') ?>" method="post">
      <div class="mb-3">
        <label for="username" class="form-label fw-semibold">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
      <p class="text-muted mb-1">Don't have an account?</p>
      <a href="<?= base_url('loanuser/register') ?>" class="btn btn-outline-secondary w-100">
        <i class="bi bi-person-plus"></i> Register
      </a>
    </div>
  </div>
</body>
</html>
