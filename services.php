<?php
require_once 'config.php';
$services = khmer_smm_api(['action' => 'services']);
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Smey Lov - តារាងសេវាកម្ម</title>
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
        <a class="nav-link" href="orders.php"><i class="fa fa-list-alt me-2"></i> My Orders</a>
        <a class="nav-link" href="funds.php"><i class="fa fa-wallet me-2"></i> Add funds</a>
        <a class="nav-link active" href="services.php"><i class="fa fa-concierge-bell me-2"></i> Services</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark">📋 បញ្ជីសេវាកម្មទាំងអស់ (Services List)</h4>
        <input type="text" id="searchBox" class="form-control w-25" placeholder="ស្វែងរកសេវាកម្ម...">
    </div>

    <div class="card p-4 border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="srvTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Rate / 1k</th>
                        <th>Min</th>
                        <th>Max</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($services)): ?>
                        <?php foreach ($services as $s): ?>
                            <tr>
                                <td><?= $s['service'] ?></td>
                                <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($s['category']) ?></span></td>
                                <td><?= htmlspecialchars($s['name']) ?></td>
                                <td class="text-success fw-bold">$<?= $s['rate'] ?></td>
                                <td><?= number_format($s['min']) ?></td>
                                <td><?= number_format($s['max']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('searchBox').addEventListener('keyup', function() {
    let q = this.value.toLowerCase();
    document.querySelectorAll('#srvTable tbody tr').forEach(r => {
        r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
</body>
</html>
