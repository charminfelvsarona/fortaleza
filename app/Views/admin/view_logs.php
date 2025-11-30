<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Network Activity Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background-color: #0d6efd;
            color: #fff;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
        }
        .header h2 {
            margin: 0;
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        table th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="header d-flex align-items-center gap-2">
                <h2 class="mb-0">🖥️ Network Activity Logs</h2>
            </div>
            <a href="<?= base_url('home') ?>" class="btn btn-back text-white">
                ← Back to Admin Panel
            </a>
        </div>

        <!-- Card Table -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Action</th>
                            <th>IP Address</th>
                            <th>MAC Address</th>
                            <th>Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php foreach($logs as $log): ?>
                                <tr>
                                    <td><?= esc($log['id']) ?></td>
                                    <td><?= esc($log['user_id']) ?></td>
                                    <td><?= esc($log['action']) ?></td>
                                    <td><?= esc($log['ip_address']) ?></td>
                                    <td><?= esc($log['mac_address']) ?></td>
                                    <td><?= esc($log['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No network activity logs found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
