<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrowers | Loan Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fc;
    }
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      padding: 20px 15px;
    }
    .sidebar h4 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 2rem;
      letter-spacing: 1px;
    }
    .sidebar .nav-link {
      color: #fff;
      font-weight: 500;
      margin: 5px 0;
      border-radius: 8px;
      padding: 10px 15px;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: rgba(255, 255, 255, 0.2);
    }
    .content {
      margin-left: 260px;
      padding: 30px;
    }
    .card {
      border: none;
      border-radius: 10px;
    }
    .table th {
      background-color: #4e73df;
      color: #fff;
    }
    .modal-header {
      border-bottom: none;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4>ADMIN PANEL</h4>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('home') ?>">
          <i class="bi bi-house-door me-2"></i> Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('borrower') ?>">
          <i class="bi bi-people-fill me-2"></i> Borrowers
        </a>
      </li>
    </ul>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold text-primary mb-0">Borrowers</h3>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-1"></i> Add Borrower
      </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Contact No</th>
              <th>Address</th>
              <th>Email</th>
              <th>Tax ID</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($borrowers)): ?>
              <?php $i = 1; foreach ($borrowers as $b): ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= esc($b['firstname'] . ' ' . $b['middlename'] . ' ' . $b['lastname']) ?></td>
                  <td><?= esc($b['contact_no']) ?></td>
                  <td><?= esc($b['address']) ?></td>
                  <td><?= esc($b['email']) ?></td>
                  <td><?= esc($b['tax_id']) ?></td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $b['borrower_id'] ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <a href="<?= base_url('borrower/delete/'.$b['borrower_id']) ?>" class="btn btn-sm btn-danger"
                      onclick="return confirm('Are you sure you want to delete this record?')">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
                </tbody>
                </table>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $b['borrower_id'] ?>" tabindex="-1">
                  <div class="modal-dialog">
                    <form action="<?= base_url('borrower/update/'.$b['borrower_id']) ?>" method="post" class="modal-content">
                      <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title">Edit Borrower</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row g-2">
                          <div class="col-md-4"><label>Firstname</label><input type="text" name="firstname" value="<?= esc($b['firstname']) ?>" class="form-control" required></div>
                          <div class="col-md-4"><label>Middlename</label><input type="text" name="middlename" value="<?= esc($b['middlename']) ?>" class="form-control" required></div>
                          <div class="col-md-4"><label>Lastname</label><input type="text" name="lastname" value="<?= esc($b['lastname']) ?>" class="form-control" required></div>
                        </div>
                        <div class="mt-3"><label>Contact No</label><input type="text" name="contact_no" value="<?= esc($b['contact_no']) ?>" class="form-control" required></div>
                        <div class="mt-3"><label>Address</label><input type="text" name="address" value="<?= esc($b['address']) ?>" class="form-control" required></div>
                        <div class="mt-3"><label>Email</label><input type="email" name="email" value="<?= esc($b['email']) ?>" class="form-control" required></div>
                        <div class="mt-3"><label>Tax ID</label><input type="number" name="tax_id" value="<?= esc($b['tax_id']) ?>" class="form-control" required></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-warning">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="7" class="text-center text-muted">No borrowers found.</td></tr>
            <?php endif; ?>
          
        
      </div>
    </div>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <form action="<?= base_url('borrower/save') ?>" method="post" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add Borrower</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-2">
            <div class="col-md-4"><label>Firstname</label><input type="text" name="firstname" class="form-control" required></div>
            <div class="col-md-4"><label>Middlename</label><input type="text" name="middlename" class="form-control" required></div>
            <div class="col-md-4"><label>Lastname</label><input type="text" name="lastname" class="form-control" required></div>
          </div>
          <div class="mt-3"><label>Contact No</label><input type="text" name="contact_no" class="form-control" required></div>
          <div class="mt-3"><label>Address</label><input type="text" name="address" class="form-control" required></div>
          <div class="mt-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
          <div class="mt-3"><label>Tax ID</label><input type="number" name="tax_id" class="form-control" required></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
