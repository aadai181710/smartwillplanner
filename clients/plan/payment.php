<?php
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = $clientId ? 'Client #' . $clientId : 'Unspecified Client';
$paymentSuccess = isset($_GET['status']) && $_GET['status'] === 'success';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment · SmartWills</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{background:#f2f6fb;font-family:Segoe UI,Roboto,sans-serif;padding:30px 20px;display:flex;justify-content:center}
        .wrapper{max-width:900px;width:100%;background:#fff;border-radius:32px;padding:30px 35px;box-shadow:0 12px 40px rgba(0,0,0,0.08)}
        @media(max-width:600px){.wrapper{padding:20px}}

        .header{display:flex;justify-content:space-between;flex-wrap:wrap;margin-bottom:24px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        .header h1{font-size:1.5rem;color:#1a2c3e;display:flex;align-items:center;gap:10px}
        .header h1 i{color:#b30707}
        .badge{background:#eef3f8;padding:4px 16px;border-radius:40px;font-size:.9rem;color:#1e466e}
        .total-badge{background:#eef3f8;padding:4px 16px;border-radius:40px;font-weight:700;font-size:1rem;color:#b30707}

        .success-box{background:#e8f5e9;border-radius:16px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:center;gap:14px;border-left:4px solid #2a9d8f}
        .success-box i{font-size:2rem;color:#2a9d8f}
        .success-box .msg{font-weight:600;color:#1a5a4a;font-size:1.05rem}

        .payment-summary{background:#f8fafd;border-radius:16px;padding:20px 24px;margin-bottom:24px}
        .payment-summary .row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px dashed #e6edf4}
        .payment-summary .row:last-child{border-bottom:none;font-weight:700;font-size:1.1rem;padding-top:12px}
        .payment-summary .row .lbl{color:#0f3b5c}
        .payment-summary .row .val{font-weight:600;color:#1e466e}
        .payment-summary .row.total .val{color:#b30707;font-size:1.2rem}

        .payment-methods{margin-bottom:24px}
        .payment-methods .label{font-weight:600;color:#0f3b5c;margin-bottom:10px;display:block}
        .method-options{display:flex;gap:12px;flex-wrap:wrap}
        .method-options label{display:flex;align-items:center;gap:8px;padding:10px 20px;border:2px solid #eef2f8;border-radius:12px;cursor:pointer;transition:.2s;font-weight:500;color:#1a2c3e}
        .method-options label:hover{border-color:#c1d7e6}
        .method-options input[type="radio"]{display:none}
        .method-options label.active{border-color:#b30707;background:#fef6f6}

        .card-details{background:#f8fafd;border-radius:16px;padding:20px 24px;margin-bottom:24px}
        .card-details .row{display:flex;gap:12px;margin-bottom:12px;flex-wrap:wrap}
        .card-details .row label{font-weight:500;color:#0f3b5c;width:100px;font-size:.9rem;display:flex;align-items:center}
        .card-details .row input{flex:1;min-width:160px;padding:8px 14px;border:1px solid #d0dce8;border-radius:30px;font-size:.9rem;outline:none}
        .card-details .row input:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .card-details .row .half{flex:0.5;min-width:100px}

        .btns{display:flex;justify-content:space-between;gap:16px;margin-top:28px;flex-wrap:wrap;border-top:1px solid #eef3f8;padding-top:20px}
        .btn{padding:8px 28px;border-radius:40px;font-weight:600;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;font-size:.95rem}
        .btn-back{background:#eef2f8;color:#2c4a66}
        .btn-back:hover{background:#dce4ed}
        .btn-pay{background:#b30707;color:#fff}
        .btn-pay:hover{background:#8f0505}
        .btn-success{background:#2a9d8f;color:#fff}
        .btn-success:hover{background:#1f7a6b}

        .secure-note{text-align:center;margin-top:16px;font-size:.8rem;color:#6f8ea3}
        .secure-note i{margin-right:6px}

        @media(max-width:700px){
            .method-options{flex-direction:column}
            .card-details .row{flex-direction:column}
            .card-details .row label{width:auto}
            .card-details .row input{width:100%}
            .btns{flex-direction:column;align-items:stretch}
            .btn{justify-content:center}
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    <div class="header">
        <h1><i class="fas fa-credit-card"></i> Payment</h1>
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <span class="total-badge"><i class="fas fa-tag"></i> $1,200</span>
        </div>
    </div>

    <!-- Payment success message -->
    <?php if ($paymentSuccess): ?>
    <div class="success-box">
        <i class="fas fa-check-circle"></i>
        <div class="msg">Payment successful! Your estate plan has been confirmed.</div>
    </div>
    <?php endif; ?>

    <!-- Payment summary -->
    <div class="payment-summary">
        <div class="row"><span class="lbl">Comprehensive Last Will &amp; Testament</span><span class="val">$1,200</span></div>
        <div class="row"><span class="lbl">LPA Form 1</span><span class="val">$0</span></div>
        <div class="row"><span class="lbl">SmartCare Trust</span><span class="val">Custom Quote</span></div>
        <div class="row"><span class="lbl">AMD (Advanced)</span><span class="val">Included</span></div>
        <div class="row total"><span class="lbl">Total Amount</span><span class="val">$1,200</span></div>
    </div>

    <!-- Payment methods (disabled after success) -->
    <div class="payment-methods">
        <span class="label">Select Payment Method</span>
        <div class="method-options" <?= $paymentSuccess ? 'style="opacity:0.5;pointer-events:none;"' : '' ?>>
            <label class="active" onclick="selectMethod(this)">
                <input type="radio" name="method" value="card" checked>
                <span><i class="fas fa-credit-card"></i> Credit Card</span>
            </label>
            <label onclick="selectMethod(this)">
                <input type="radio" name="method" value="paypal">
                <span><i class="fab fa-paypal"></i> PayPal</span>
            </label>
            <label onclick="selectMethod(this)">
                <input type="radio" name="method" value="bank">
                <span><i class="fas fa-university"></i> Bank Transfer</span>
            </label>
        </div>
    </div>

    <!-- Card details (disabled after success) -->
    <div class="card-details" id="cardDetails" <?= $paymentSuccess ? 'style="opacity:0.5;pointer-events:none;"' : '' ?>>
        <div class="row">
            <label>Card Number</label>
            <input type="text" placeholder="1234 5678 9012 3456">
        </div>
        <div class="row">
            <label>Cardholder Name</label>
            <input type="text" placeholder="John Doe">
        </div>
        <div class="row">
            <label>Expiry Date</label>
            <input type="text" placeholder="MM/YY" class="half">
            <label style="width:auto;margin-left:12px;">CVV</label>
            <input type="text" placeholder="123" style="flex:0.3;min-width:70px;">
        </div>
    </div>

    <!-- Navigation buttons -->
    <div class="btns">
        <a href="recommendations.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Recommendations</a>
        
        <?php if ($paymentSuccess): ?>
            <!-- Payment success → show Back to Clients -->
            <a href="javascript:void(0)" class="btn btn-success" onclick="closeAndRedirect()">
                <i class="fas fa-check"></i> Back to Clients
            </a>
        <?php else: ?>
            <!-- Not paid → show Pay -->
            <a href="payment.php?id=<?=$clientId?>&status=success" class="btn btn-pay">
                <i class="fas fa-lock"></i> Pay $1,200
            </a>
        <?php endif; ?>
    </div>

    <div class="secure-note">
        <i class="fas fa-lock"></i> Your payment is secure and encrypted.
    </div>
</div>

<script>
function selectMethod(el) {
    document.querySelectorAll('.method-options label').forEach(l => l.classList.remove('active'));
    el.classList.add('active');
}

function closeAndRedirect() {
    try {
        window.location.href = '../clients.php';
        window.close();
        setTimeout(function() {
            window.location.href = '../clients.php';
        }, 500);
    } catch (e) {
        window.location.href = '../clients.php';
    }
}
</script>
</body>
</html>