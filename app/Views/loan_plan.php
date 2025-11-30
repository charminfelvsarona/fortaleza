<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Plans</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fc; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: #fff;
        }
        .sidebar a { color: #fff; text-decoration: none; }
        .sidebar .nav-link.active { background-color: rgba(255,255,255,0.2); border-radius: 8px; }
        .content-wrapper { margin-left: 250px; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3 position-fixed" style="width:250px;">
        <h4 class="text-center mb-4">ADMIN PANEL</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="/home"><i class="fa fa-home me-2"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="/loan-plans"><i class="fa fa-piggy-bank me-2"></i> Loan Plans</a></li>
            
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Loan Plans</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fa fa-plus"></i> Add Plan
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="loanTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Months</th>
                                <th>Interest (%)</th>
                                <th>Penalty (%)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($loanPlans as $plan): ?>
                            <tr>
                                <td><?= esc($plan['lplan_month']) ?></td>
                                <td><?= esc($plan['lplan_interest']) ?></td>
                                <td><?= esc($plan['lplan_penalty']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $plan['lplan_id'] ?>"><i class="fa fa-edit"></i></button>
                                    <a href="/loan-plans/delete/<?= $plan['lplan_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this loan plan?');"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $plan['lplan_id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="/loan-plans/update/<?= $plan['lplan_id'] ?>" class="modal-content">
                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title">Edit Loan Plan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Months</label>
                                                <input type="number" name="lplan_month" value="<?= esc($plan['lplan_month']) ?>" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Interest (%)</label>
                                                <input type="number" name="lplan_interest" step="0.01" value="<?= esc($plan['lplan_interest']) ?>" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Penalty (%)</label>
                                                <input type="number" name="lplan_penalty" value="<?= esc($plan['lplan_penalty']) ?>" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="/loan-plans/store" class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Loan Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Months</label>
                    <input type="number" name="lplan_month" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Interest (%)</label>
                    <input type="number" step="0.01" name="lplan_interest" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penalty (%)</label>
                    <input type="number" name="lplan_penalty" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(() => $('#loanTable').DataTable());
</script>

</body>
</html>
