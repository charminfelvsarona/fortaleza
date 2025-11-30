<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Employee Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0d6efd, #6ea8fe);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Poppins", sans-serif;
    }
    .login-card {
      background: #fff;
      padding: 2rem 2.5rem;
      border-radius: 15px;
      box-shadow: 0 5px 25px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-card h3 {
      text-align: center;
      color: #0d6efd;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-primary {
      width: 100%;
      border-radius: 10px;
      font-weight: 600;
    }
    .btn-outline-primary {
      width: 100%;
      border-radius: 10px;
      font-weight: 600;
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="login-card">
    <h3><i class="bi bi-person-circle"></i> Admin Login</h3>

    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('login/auth') ?>" method="post">
      <div class="mb-3">
        <label for="username" class="form-label fw-semibold">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
      </div>

      <button type="submit" class="btn btn-primary mt-3">
        <i class="bi bi-box-arrow-in-right"></i> Login
      </button>
    </form>

    <!-- 🔹 New Button to Go to Employee Login -->
    <div class="text-center mt-3">
  <a href="<?= site_url('loanuser/login') ?>" class="btn btn-outline-primary w-100">
    <i class="bi bi-person-badge"></i> Login as Loan User
  </a>
</div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
