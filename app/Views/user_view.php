<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel | User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
      color: #fff;
      flex-shrink: 0;
    }
    .sidebar h4 {
      text-align: center;
      padding: 20px;
      background-color: #224abe;
      margin: 0;
      font-weight: 600;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      border-bottom: 1px solid #343a40;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      flex-grow: 1;
      padding: 30px;
    }
    .navbar-brand {
      font-weight: 600;
    }
    .modal-header {
      border-bottom: none;
    }
  </style>
</head>
<body>

   <!-- Sidebar -->
  <div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="<?= base_url('home') ?>">🏠 Home</a>
    <a href="<?= base_url('borrower') ?>">👥 Borrower</a>
    <a href="<?= base_url('user') ?>">🧑‍💼 Users</a>
  </div>

  <!-- Main Content -->
  <div class="content">
    <h2 class="mb-4">User Management</h2>

    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">➕ Add User</button>

    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Password</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($users)): $i=1; foreach($users as $user): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= esc($user['username']) ?></td>
          <td><?= esc($user['firstname']) ?></td>
          <td><?= esc($user['lastname']) ?></td>
          <td><?= str_repeat('*', strlen($user['password'])) ?></td>
          <td>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['user_id'] ?>">Edit</button>
            <a href="<?= base_url('user/delete/'.$user['user_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</a>
          </td>
        </tr>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?= $user['user_id'] ?>" tabindex="-1">
          <div class="modal-dialog">
            <form action="<?= base_url('user/update/'.$user['user_id']) ?>" method="post" class="modal-content">
              <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="text" name="username" value="<?= esc($user['username']) ?>" class="form-control mb-2" placeholder="Username" required>
                <input type="text" name="password" value="<?= esc($user['password']) ?>" class="form-control mb-2" placeholder="Password" required>
                <input type="text" name="firstname" value="<?= esc($user['firstname']) ?>" class="form-control mb-2" placeholder="Firstname" required>
                <input type="text" name="lastname" value="<?= esc($user['lastname']) ?>" class="form-control mb-2" placeholder="Lastname" required>
              </div>
              <div class="modal-footer">
                <button class="btn btn-warning">Update</button>
              </div>
            </form>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
      <form action="<?= site_url('user/save') ?>" method="post" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
          <input type="text" name="password" class="form-control mb-2" placeholder="Password" required>
          <input type="text" name="firstname" class="form-control mb-2" placeholder="Firstname" required>
          <input type="text" name="lastname" class="form-control mb-2" placeholder="Lastname" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>