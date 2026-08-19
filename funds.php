<?php
require_once 'config.php';

// Function សម្រាប់គណនា CRC16 (CCITT-FALSE) សម្រាប់ស្តង់ដារ EMVCo KHQR
function emv_crc16($str) {
    $crc = 0xFFFF;
    for ($c = 0; $c < strlen($str); $c++) {
        $crc ^= (ord($str[$c]) << 8);
        for ($i = 0; $i < 8; $i++) {
            if ($crc & 0x8000) {
                $crc = (($crc << 1) ^ 0x1021) & 0xFFFF;
            } else {
                $crc = ($crc << 1) & 0xFFFF;
            }
        }
    }
    return strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
}

// Function ជំនួយសម្រាប់រៀបចំ TLV (Tag-Length-Value)
function tlv($tag, $val) {
    $len = str_pad(strlen($val), 2, '0', STR_PAD_LEFT);
    return $tag . $len . $val;
}

// Function បង្កើត Bakong KHQR String
function generateBakongKHQR($bakongId, $amount, $merchantName = 'Smey Lov', $city = 'Phnom Penh') {
    // 29: Merchant Account Information សម្រាប់ Bakong
    $sub29_00 = tlv('00', $bakongId); // Bakong Account ID
    $tag29 = tlv('29', $sub29_00);

    $qrData = '';
    $qrData .= tlv('00', '01');                            // Payload Format Indicator
    $qrData .= tlv('01', '12');                            // 12 = Dynamic QR (មានកំណត់ចំនួនទឹកប្រាក់)
    $qrData .= $tag29;                                     // Merchant Account Info
    $qrData .= tlv('52', '0000');                          // Merchant Category Code
    $qrData .= tlv('53', '840');                           // Transaction Currency (840 = USD)
    $qrData .= tlv('54', number_format($amount, 2, '.', '')); // Transaction Amount
    $qrData .= tlv('58', 'KH');                            // Country Code
    $qrData .= tlv('59', $merchantName);                   // Merchant Name
    $qrData .= tlv('60', $city);                           // Merchant City
    $qrData .= '6304';                                     // CRC Tag + Length

    $crc = emv_crc16($qrData);
    return $qrData . $crc;
}

$qr_string = '';
$qr_image_url = '';
$amount_paid = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $amount_paid = floatval($_POST['amount']);
    if ($amount_paid > 0) {
        $bakong_account = 'samnang_mon@bkrt';
        $qr_string = generateBakongKHQR($bakong_account, $amount_paid, 'Smey Lov');
        // បង្កើតជារូបភាព QR Code ចេញពី QR String របស់ Bakong
        $qr_image_url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($qr_string);
    }
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Smey Lov - បញ្ចូលទឹកប្រាក់ KHQR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Kantumruy Pro', sans-serif; }
        .sidebar { width: 250px; position: fixed; top: 0; bottom: 0; left: 0; background: #0c1a30; padding-top: 20px; }
        .sidebar .nav-link { color: #a3b1cc; padding: 12px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #192d47; color: #fff; }
        .main-content { margin-left: 250px; padding: 30px; }
        .amount-btn { border: 1px solid #dee2e6; background: #fff; padding: 10px; border-radius: 8px; cursor: pointer; text-align: center; font-weight: bold; transition: 0.2s; }
        .amount-btn:hover { background: #0d6efd; color: #fff; border-color: #0d6efd; }
        .khqr-card { border-radius: 16px; border: 2px solid #e63946; background: #fff; overflow: hidden; }
        .khqr-header { background: #e63946; color: #fff; padding: 12px; font-weight: bold; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-4"><h3 class="text-white fw-bold">Smey Lov</h3></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php"><i class="fa fa-shopping-cart me-2"></i> New order</a>
        <a class="nav-link" href="orders.php"><i class="fa fa-list-alt me-2"></i> My Orders</a>
        <a class="nav-link active" href="funds.php"><i class="fa fa-wallet me-2"></i> Add funds</a>
        <a class="nav-link" href="services.php"><i class="fa fa-concierge-bell me-2"></i> Services</a>
    </nav>
</div>

<div class="main-content">
    <h4 class="fw-bold mb-4">💳 បញ្ចូលសមតុល្យទឹកប្រាក់ (Add Funds)</h4>
    <div class="row g-4">
        
        <!-- Form បញ្ចូលចំនួនលុយ -->
        <div class="col-md-6">
            <div class="card p-4 border-0 shadow-sm">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">វិធីសាស្ត្រទូទាត់ (Payment Method)</label>
                        <input type="text" class="form-control" value="Bakong KHQR (ABA, Acleda, Chip Mong, etc.)" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">ចំនួនទឹកប្រាក់ ($ USD)</label>
                        <input type="number" name="amount" id="amountInput" class="form-control form-control-lg" placeholder="0.00" step="0.01" min="0.10" required value="<?= $amount_paid > 0 ? htmlspecialchars($amount_paid) : '' ?>">
                    </div>
                    
                    <!-- ប៊ូតុងរើសចំនួនទឹកប្រាក់រហ័ស -->
                    <div class="row g-2 mb-4">
                        <div class="col-3"><div class="amount-btn" onclick="setAmount(1)">$1</div></div>
                        <div class="col-3"><div class="amount-btn" onclick="setAmount(3)">$3</div></div>
                        <div class="col-3"><div class="amount-btn" onclick="setAmount(5)">$5</div></div>
                        <div class="col-3"><div class="amount-btn" onclick="setAmount(10)">$10</div></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold fs-5">Generate KHQR</button>
                </form>
            </div>
        </div>

        <!-- ផ្ទាំងបង្ហាញ Bakong KHQR Popup / Box -->
        <?php if ($qr_image_url): ?>
        <div class="col-md-6">
            <div class="khqr-card shadow text-center">
                <div class="khqr-header fs-5">
                    <i class="fa fa-qrcode me-2"></i> KHQR Payment
                </div>
                <div class="p-4">
                    <p class="mb-1 text-muted">ស្កេនទូទាត់ទៅកាន់គណនី៖</p>
                    <h5 class="fw-bold text-dark mb-1">Smey Lov</h5>
                    <span class="badge bg-light text-secondary border mb-3">samnang_mon@bkrt</span>
                    
                    <div class="my-2">
                        <img src="<?= $qr_image_url ?>" alt="Bakong KHQR" class="img-fluid border p-2 rounded shadow-sm" style="max-width: 230px;">
                    </div>
                    
                    <h3 class="fw-bold text-danger my-3">$<?= number_format($amount_paid, 2) ?></h3>
                    <p class="small text-muted mb-0">លោកអ្នកអាចបើក App ធនាគារណាក៏បាន (ABA, Bakong, Acleda...) ដើម្បីស្កេនទូទាត់ប្រាក់។</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
function setAmount(val) {
    document.getElementById('amountInput').value = val;
}
</script>

</body>
</html>
