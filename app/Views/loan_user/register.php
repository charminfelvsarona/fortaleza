<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loan User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="card shadow p-4" style="width: 400px;">
    <h4 class="text-center text-success mb-3">
      <i class="bi bi-person-plus"></i> Register Account
    </h4>

    <form action="<?= base_url('loanuser/registerPost') ?>" method="post">
      <div class="mb-3">
        <label for="firstname" class="form-label fw-semibold">First Name</label>
        <input type="text" name="firstname" id="firstname" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="lastname" class="form-label fw-semibold">Last Name</label>
        <input type="text" name="lastname" id="lastname" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="username" class="form-label fw-semibold">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Register</button>

      <div class="text-center mt-3">
        <a href="<?= base_url('loanuser/login') ?>" class="text-decoration-none">Back to Login</a>
      </div>
    </form>
  </div>
</body>
</html>
