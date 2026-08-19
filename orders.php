<?php
require_once 'config.php';
$ordersData = khmer_smm_api(['action' => 'orders']);
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Smey Lov - ប្រវត្តិការកុម្ម៉ង់</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Kantumruy Pro', sans-serif; }
        .sidebar { width: 250px; position: fixed; top: 0; bottom: 0; left: 0; background: #0c1a30; padding-top: 20px; }
        .sidebar .nav-link { color: #a3b1cc; padding: 12px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #192d47; color: #fff; }
        .main-content { margin-left: 250px; padding: 30px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-4"><h3 class="text-white fw-bold">Smey Lov</h3></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php"><i class="fa fa-shopping-cart me-2"></i> New order</a>
        <a class="nav-link active" href="orders.php"><i class="fa fa-list-alt me-2"></i> My Orders</a>
        <a class="nav-link" href="funds.php"><i class="fa fa-wallet me-2"></i> Add funds</a>
        <a class="nav-link" href="services.php"><i class="fa fa-concierge-bell me-2"></i> Services</a>
    </nav>
</div>

<div class="main-content">
    <h4 class="fw-bold text-dark mb-4">📋 ប្រវត្តិនៃការកុម្ម៉ង់ទិញ (Order History)</h4>
    <div class="card p-4 border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Link</th>
                        <th>Charge</th>
                        <th>Quantity</th>
                        <th>Service ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($ordersData) && !isset($ordersData['error'])): ?>
                        <?php foreach ($ordersData as $order): ?>
                            <tr>
                                <td><strong>#<?= $order['order'] ?></strong></td>
                                <td><a href="<?= htmlspecialchars($order['link']) ?>" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;"><?= htmlspecialchars($order['link']) ?></a></td>
                                <td class="text-success fw-bold">$<?= htmlspecialchars($order['charge'] ?? '0.00') ?></td>
                                <td><?= htmlspecialchars($order['quantity'] ?? '0') ?></td>
                                <td><span class="badge bg-secondary">#<?= htmlspecialchars($order['service'] ?? '') ?></span></td>
                                <td>
                                    <?php 
                                    $status = strtolower($order['status'] ?? '');
                                    if ($status == 'completed') echo '<span class="badge bg-success">Completed</span>';
                                    elseif ($status == 'in progress') echo '<span class="badge bg-info text-dark">In Progress</span>';
                                    elseif ($status == 'processing') echo '<span class="badge bg-warning text-dark">Processing</span>';
                                    else echo '<span class="badge bg-secondary">'.ucfirst($status).'</span>';
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center text-muted">មិនទាន់មានទិន្នន័យកុម្ម៉ង់ឡើយ។</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
