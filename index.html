<?php
require_once 'config.php';

// ទាញយកសមតុល្យ និងសេវាកម្មទាំងអស់
$balanceData = khmer_smm_api(['action' => 'balance']);
$balance = $balanceData['balance'] ?? '0.00';

$services = khmer_smm_api(['action' => 'services']);

// ចាត់ក្រុមសេវាកម្មតាម Category
$categories = [];
if (is_array($services)) {
    foreach ($services as $srv) {
        $categories[$srv['category']][] = $srv;
    }
}

// ដំណើរការកម្ម៉ង់ Order
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $res = khmer_smm_api([
        'action' => 'add',
        'service' => $_POST['service'],
        'link' => $_POST['link'],
        'quantity' => $_POST['quantity']
    ]);
    
    if (isset($res['order'])) {
        $msg = "<div class='alert alert-success'>កម្ម៉ង់បានជោគជ័យ! លេខកូដទិញ៖ #".$res['order']."</div>";
    } else {
        $msg = "<div class='alert alert-danger'>កំហុស៖ ".($res['error'] ?? 'មិនអាចដំណើរការបាន')."</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Smey Lov - New Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Kantumruy Pro', sans-serif; }
        .sidebar { width: 250px; position: fixed; top: 0; bottom: 0; left: 0; background: #0c1a30; color: #fff; padding-top: 20px; }
        .sidebar .nav-link { color: #a3b1cc; padding: 12px 20px; font-size: 15px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #192d47; color: #fff; }
        .main-content { margin-left: 250px; padding: 30px; }
        .navbar-custom { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.04); padding: 15px 30px; margin-left: 250px; }
        .icon-btn { border: 1px solid #dee2e6; background: #fff; padding: 15px; border-radius: 8px; text-align: center; cursor: pointer; transition: 0.2s; }
        .icon-btn:hover, .icon-btn.active { border-color: #0d6efd; background: #ecf4ff; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-white">Smey Lov</h3>
        <span class="badge bg-primary">User: Nang150</span>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link active" href="index.php"><i class="fa fa-shopping-cart me-2"></i> New order</a>
        <a class="nav-link" href="orders.php"><i class="fa fa-list-alt me-2"></i> My Orders</a>
        <a class="nav-link" href="funds.php"><i class="fa fa-wallet me-2"></i> Add funds</a>
        <a class="nav-link" href="services.php"><i class="fa fa-concierge-bell me-2"></i> Services</a>
    </nav>
</div>

<!-- Top Navbar -->
<div class="navbar-custom d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-bold">របៀបរៀបរយ៖ New order</h5>
    <div>
        <span class="me-3 fw-bold">សមតុល្យគណនី៖ <span class="text-success">$<?= number_format((float)$balance, 4) ?></span></span>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <?= $msg ?>
    
    <!-- Quick Category Icons -->
    <div class="row g-3 mb-4">
        <div class="col-md-2 col-4"><div class="icon-btn active" data-cat="all"><i class="fa fa-th text-primary d-block mb-1 fs-4"></i> Everythings</div></div>
        <div class="col-md-2 col-4"><div class="icon-btn" data-cat="TikTok"><i class="fab fa-tiktok text-dark d-block mb-1 fs-4"></i> TikTok</div></div>
        <div class="col-md-2 col-4"><div class="icon-btn" data-cat="Facebook"><i class="fab fa-facebook text-primary d-block mb-1 fs-4"></i> Facebook</div></div>
        <div class="col-md-2 col-4"><div class="icon-btn" data-cat="YouTube"><i class="fab fa-youtube text-danger d-block mb-1 fs-4"></i> YouTube</div></div>
        <div class="col-md-2 col-4"><div class="icon-btn" data-cat="Telegram"><i class="fab fa-telegram text-info d-block mb-1 fs-4"></i> Telegram</div></div>
        <div class="col-md-2 col-4"><div class="icon-btn" data-cat="Instagram"><i class="fab fa-instagram text-warning d-block mb-1 fs-4"></i> Instagram</div></div>
    </div>

    <div class="row g-4">
        <!-- Place Order Form -->
        <div class="col-lg-7">
            <div class="card p-4 border-0 shadow-sm">
                <form method="POST" id="orderForm">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select class="form-select" id="categorySelect" required>
                            <option value="">-- Select Category --</option>
                            <?php foreach (array_keys($categories) as $catName): ?>
                                <option value="<?= htmlspecialchars($catName) ?>"><?= htmlspecialchars($catName) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Service</label>
                        <select name="service" class="form-select" id="serviceSelect" required disabled>
                            <option value="">-- Select Service --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Link</label>
                        <input type="text" name="link" class="form-control" placeholder="https://..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="number" name="quantity" id="quantityInput" class="form-control" required disabled>
                        <div class="form-text" id="minMaxText"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Charge (តម្លៃសរុប)</label>
                        <input type="text" class="form-control fw-bold text-success" id="chargeDisplay" value="$0.00" readonly>
                    </div>

                    <button type="submit" name="place_order" class="btn btn-primary w-100 py-2 fw-bold">Submit Order</button>
                </form>
            </div>
        </div>

        <!-- Service Details Panel (Right Side) -->
        <div class="col-lg-5">
            <div class="card p-4 border-0 shadow-sm bg-white h-100">
                <h5 class="fw-bold text-primary mb-3"><i class="fa fa-info-circle me-2"></i> Service details</h5>
                <div id="detailsContent" class="text-muted">
                    <p>សូមជ្រើសរើសសេវាកម្មដើម្បីមើលព័ត៌មានលម្អិតនៅទីនេះ...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const servicesData = <?= json_encode($categories) ?>;

document.querySelectorAll('.icon-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.icon-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.getAttribute('data-cat');
        
        const catSelect = document.getElementById('categorySelect');
        if(filter === 'all') {
            catSelect.value = "";
        } else {
            for(let option of catSelect.options) {
                if(option.value.toLowerCase().includes(filter.toLowerCase())) {
                    catSelect.value = option.value;
                    catSelect.dispatchEvent(new Event('change'));
                    break;
                }
            }
        }
    });
});

document.getElementById('categorySelect').addEventListener('change', function() {
    const serviceSelect = document.getElementById('serviceSelect');
    const cat = this.value;
    serviceSelect.innerHTML = '<option value="">-- Select Service --</option>';
    
    if(cat && servicesData[cat]) {
        servicesData[cat].forEach(srv => {
            serviceSelect.innerHTML += `<option value="${srv.service}" data-rate="${srv.rate}" data-min="${srv.min}" data-max="${srv.max}" data-type="${srv.type}">${srv.name} - $${srv.rate}</option>`;
        });
        serviceSelect.disabled = false;
    } else {
        serviceSelect.disabled = true;
    }
    document.getElementById('quantityInput').disabled = true;
});

document.getElementById('serviceSelect').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const qtyInput = document.getElementById('quantityInput');
    
    if(this.value) {
        const min = selected.getAttribute('data-min');
        const max = selected.getAttribute('data-max');
        document.getElementById('minMaxText').innerText = `Min: ${parseInt(min).toLocaleString()} - Max: ${parseInt(max).toLocaleString()}`;
        qtyInput.min = min;
        qtyInput.max = max;
        qtyInput.disabled = false;
        
        document.getElementById('detailsContent').innerHTML = `
            <p><strong>Service ID:</strong> ${this.value}</p>
            <p><strong>Rate per 1k:</strong> $${selected.getAttribute('data-rate')}</p>
            <p><strong>Type:</strong> ${selected.getAttribute('data-type')}</p>
            <p class="alert alert-warning p-2"><i class="fa fa-bolt"></i> Start Time: Instant / 0-5 Minutes.</p>
        `;
    } else {
        qtyInput.disabled = true;
        document.getElementById('minMaxText').innerText = '';
    }
});

document.getElementById('quantityInput').addEventListener('input', function() {
    const serviceSelect = document.getElementById('serviceSelect');
    const selected = serviceSelect.options[serviceSelect.selectedIndex];
    if(selected && this.value) {
        const rate = parseFloat(selected.getAttribute('data-rate'));
        const qty = parseInt(this.value);
        const total = (rate / 1000) * qty;
        document.getElementById('chargeDisplay').value = `$${total.toFixed(4)}`;
    } else {
        document.getElementById('chargeDisplay').value = `$0.00`;
    }
});
</script>
</body>
</html>
