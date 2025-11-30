<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loan Types | Loan Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fc;
      font-family: 'Segoe UI', sans-serif;
    }
    .sidebar {
      height: 100vh;
      background: #0d6efd;
      color: white;
      position: fixed;
      width: 230px;
      top: 0;
      left: 0;
      padding-top: 1rem;
    }
    .sidebar a {
      color: white;
      display: block;
      padding: 0.75rem 1.25rem;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background: rgba(255,255,255,0.2);
      border-radius: 5px;
    }
    .content {
      margin-left: 240px;
      padding: 2rem;
    }
    .card {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="text-center mb-4">
    <h5 class="fw-bold">Loan Management</h5>
  </div>
  <a href="<?= base_url('home') ?>"><i class="bi bi-house-door"></i> Home</a>
  <a href="<?= base_url('loan-type') ?>" class="active"><i class="bi bi-cash-coin"></i> Loan Types</a>
  
</div>

<!-- Main Content -->
<div class="content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary">Loan Types</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
      <i class="bi bi-plus-circle"></i> Add Loan Type
    </button>
  </div>

  <!-- Success Message -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Loan Type Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Loan Name</th>
              <th scope="col">Description</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($loanTypes)): ?>
              <?php $i=1; foreach ($loanTypes as $row): ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= esc($row['ltype_name']) ?></td>
                  <td><?= esc($row['ltype_desc']) ?></td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['ltype_id'] ?>">
                      <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <a href="<?= base_url('loan-type/delete/'.$row['ltype_id']) ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this record?');">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                  </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $row['ltype_id'] ?>" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="<?= base_url('loan-type/update/'.$row['ltype_id']) ?>" method="post">
                        <div class="modal-header bg-warning text-white">
                          <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit Loan Type</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Loan Name</label>
                            <input type="text" name="ltype_name" value="<?= esc($row['ltype_name']) ?>" class="form-control" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Loan Description</label>
                            <textarea name="ltype_desc" class="form-control" rows="3" required><?= esc($row['ltype_desc']) ?></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button class="btn btn-warning">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center text-muted">No loan types found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('loan-type/save') ?>" method="post">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Add Loan Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Loan Name</label>
            <input type="text" name="ltype_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Loan Description</label>
            <textarea name="ltype_desc" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
