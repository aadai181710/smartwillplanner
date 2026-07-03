<?php
$activePage = 'clients';
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = 'Zhang Wei';
$paymentSuccess = isset($_GET['status']) && $_GET['status'] === 'success';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Payment · SmartWills</title>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/topbar.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
    <link rel="stylesheet" href="../../assets/css/payment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
        <!-- /* 基础布局 */
        html,body{height:100%;margin:0}
        .wrapper{display:flex;height:100vh;overflow:hidden}
        .sidebar{position:fixed;top:0;left:0;height:100vh;width:250px;overflow-y:auto;z-index:1000;background:#fff;border-right:1px solid #eef2f8}
        .main-content{margin-left:250px;display:flex;flex-direction:column;height:100vh;overflow:hidden;flex:1}
        .topbar{position:sticky;top:0;z-index:999;background:#fff;border-bottom:1px solid #eef2f8}
        .content{flex:1;overflow-y:auto;padding:20px 20px 0}
        .payment-wrapper{width:100%;background:#fff;border-radius:32px;box-shadow:0 12px 40px rgba(0,0,0,0.08);padding:24px 30px 30px}

        /* 进度条 */
        .progress-steps{display:flex;align-items:flex-start;justify-content:space-between;position:relative;margin-bottom:28px;padding:0 6px}
        .progress-steps::before{content:'';position:absolute;top:22px;left:0;right:0;height:2px;background:#e0e8ef;z-index:0}
        .step{display:flex;flex-direction:column;align-items:center;flex:1;position:relative;z-index:1;text-align:center}
        .step .circle{width:44px;height:44px;border-radius:50%;background:#e0e8ef;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;transition:background .2s;flex-shrink:0}
        .step.active .circle{background:#b30707;box-shadow:0 4px 10px rgba(179,7,7,0.25)}
        .step .label{margin-top:8px;font-size:.75rem;color:#7a93ab;font-weight:500;line-height:1.2;max-width:90px;word-break:break-word}
        .step.active .label{color:#b30707;font-weight:700}

        /* 头部 */
        .header{display:flex;justify-content:space-between;flex-wrap:wrap;margin-bottom:24px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        .header h1{font-size:1.5rem;color:#1a2c3e;display:flex;align-items:center;gap:10px}
        .header h1 i{color:#b30707}
        .total-badge{background:#eef3f8;padding:4px 16px;border-radius:40px;font-weight:700;font-size:1rem;color:#b30707}

        /* 成功框 */
        .success-box{background:#e8f5e9;border-radius:16px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:center;gap:14px;border-left:4px solid #2a9d8f}
        .success-box i{font-size:2rem;color:#2a9d8f}
        .success-box .msg{font-weight:600;color:#1a5a4a;font-size:1.05rem}

        /* 摘要 */
        .payment-summary{background:#f8fafd;border-radius:16px;padding:20px 24px;margin-bottom:24px}
        .payment-summary .row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px dashed #e6edf4}
        .payment-summary .row:last-child{border-bottom:none;font-weight:700;font-size:1.1rem;padding-top:12px}
        .payment-summary .row .lbl{color:#0f3b5c}
        .payment-summary .row .val{font-weight:600;color:#1e466e}
        .payment-summary .row.total .val{color:#b30707;font-size:1.2rem}

        /* 支付方式 */
        .payment-methods{margin-bottom:24px}
        .payment-methods .label{font-weight:600;color:#0f3b5c;margin-bottom:10px;display:block}
        .method-options{display:flex;gap:12px;flex-wrap:wrap}
        .method-options label{display:flex;align-items:center;gap:8px;padding:10px 20px;border:2px solid #eef2f8;border-radius:12px;cursor:pointer;transition:.2s;font-weight:500;color:#1a2c3e}
        .method-options label:hover{border-color:#c1d7e6}
        .method-options input[type="radio"]{display:none}
        .method-options label.active{border-color:#b30707;background:#fef6f6}

        /* 卡片详情 */
        .card-details{background:#f8fafd;border-radius:16px;padding:20px 24px;margin-bottom:24px}
        .card-details .row{display:flex;gap:12px;margin-bottom:12px;flex-wrap:wrap}
        .card-details .row label{font-weight:500;color:#0f3b5c;width:100px;font-size:.9rem;display:flex;align-items:center}
        .card-details .row input{flex:1;min-width:160px;padding:8px 14px;border:1px solid #d0dce8;border-radius:30px;font-size:.9rem;outline:none}
        .card-details .row input:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .card-details .row .half{flex:0.5;min-width:100px}

        /* 按钮 */
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

        /* ===== 响应式 ===== */
        @media(max-width:1024px){
            .payment-wrapper{padding:20px 24px 24px}
            .step .circle{width:38px;height:38px;font-size:.85rem}
            .step .label{font-size:.65rem;max-width:72px}
            .progress-steps::before{top:19px}
            .header h1{font-size:1.3rem}
        }
        @media(max-width:768px){
            .sidebar{width:200px}
            .main-content{margin-left:200px}
            .payment-wrapper{padding:16px 18px 20px;border-radius:24px}
            .progress-steps{margin-bottom:20px;padding:0;flex-wrap:nowrap;overflow-x:auto;gap:4px}
            .progress-steps::before{top:16px;left:10px;right:10px}
            .step{flex:0 0 auto;min-width:50px}
            .step .circle{width:32px;height:32px;font-size:.7rem}
            .step .label{font-size:.55rem;max-width:52px;margin-top:4px}
            .header{flex-direction:column;align-items:flex-start;gap:10px;padding-bottom:12px;margin-bottom:18px}
            .header h1{font-size:1.2rem}
            .total-badge{font-size:.9rem}
            .method-options{flex-direction:column}
            .card-details .row{flex-direction:column}
            .card-details .row label{width:auto}
            .card-details .row input{width:100%;min-width:0}
            .card-details .row .half{flex:1;min-width:0}
            .btns{flex-direction:column;align-items:stretch}
            .btn{justify-content:center;padding:10px 20px;font-size:.9rem}
            .success-box{padding:16px 18px}
            .success-box i{font-size:1.5rem}
            .success-box .msg{font-size:.95rem}
            .payment-summary{padding:16px 18px}
            .payment-summary .row{font-size:.9rem}
            .payment-summary .row.total .val{font-size:1.05rem}
            .card-details{padding:16px 18px}
            .card-details .row input{padding:6px 12px;font-size:.85rem}
        }
        @media(max-width:480px){
            .sidebar{width:170px}
            .main-content{margin-left:170px}
            .content{padding:12px 10px 0}
            .payment-wrapper{padding:12px 14px 16px;border-radius:20px}
            .progress-steps{margin-bottom:16px}
            .step .circle{width:26px;height:26px;font-size:.6rem}
            .step .label{font-size:.45rem;max-width:40px}
            .progress-steps::before{top:13px}
            .header h1{font-size:1rem;gap:6px}
            .total-badge{font-size:.8rem;padding:3px 12px}
            .success-box{padding:14px 16px}
            .success-box i{font-size:1.2rem}
            .success-box .msg{font-size:.85rem}
            .payment-summary{padding:14px 16px}
            .payment-summary .row{padding:6px 0;font-size:.85rem}
            .payment-summary .row.total .val{font-size:1rem}
            .method-options label{padding:8px 14px;font-size:.85rem}
            .card-details{padding:14px 16px}
            .card-details .row input{font-size:.8rem;padding:5px 10px}
            .btn{padding:8px 16px;font-size:.8rem;gap:6px}
            .btns{gap:10px;margin-top:20px;padding-top:16px}
            .secure-note{font-size:.7rem}
        }
        @media(max-width:400px){
            .sidebar{width:140px}
            .main-content{margin-left:140px}
            .content{padding:8px 6px 0}
            .payment-wrapper{padding:10px 10px 14px;border-radius:16px}
        }
    </style> -->
</head>
<body>
<div class="wrapper">
    <?php include '../../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../../layouts/topbar.php'; ?>
        <div class="content">
            <div class="payment-wrapper">
                <!-- 进度条 -->
                <div class="progress-steps">
                    <div class="step"><span class="circle">1</span><span class="label">My Assets</span></div>
                    <div class="step"><span class="circle">2</span><span class="label">Estate Planning Checklist</span></div>
                    <div class="step"><span class="circle">3</span><span class="label">Estate Fund Need Analysis</span></div>
                    <div class="step"><span class="circle">4</span><span class="label">Funding Gap</span></div>
                    <div class="step"><span class="circle">5</span><span class="label">Product Recommendations</span></div>
                    <div class="step active"><span class="circle">6</span><span class="label">Payment</span></div>
                </div>

                <div class="header">
                    <h1><i class="fas fa-credit-card"></i> Payment</h1>
                    <span class="total-badge"><i class="fas fa-tag"></i> $1,200</span>
                </div>

                <?php if ($paymentSuccess): ?>
                <div class="success-box">
                    <i class="fas fa-check-circle"></i>
                    <div class="msg">Payment successful! Your estate plan has been confirmed.</div>
                </div>
                <?php endif; ?>

                <div class="payment-summary">
                    <div class="row"><span class="lbl">Comprehensive Last Will &amp; Testament</span><span class="val">$1,200</span></div>
                    <div class="row"><span class="lbl">LPA Form 1</span><span class="val">$0</span></div>
                    <div class="row"><span class="lbl">SmartCare Trust</span><span class="val">Custom Quote</span></div>
                    <div class="row"><span class="lbl">AMD (Advanced)</span><span class="val">Included</span></div>
                    <div class="row total"><span class="lbl">Total Amount</span><span class="val">$1,200</span></div>
                </div>

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

                <div class="btns">
                    <a href="recommendations.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Recommendations</a>
                    <?php if ($paymentSuccess): ?>
                        <a href="../clients.php" class="btn btn-success"><i class="fas fa-check"></i> Back to Clients</a>
                    <?php else: ?>
                        <a href="payment.php?id=<?=$clientId?>&status=success" class="btn btn-pay"><i class="fas fa-lock"></i> Pay $1,200</a>
                    <?php endif; ?>
                </div>
                <div class="secure-note"><i class="fas fa-lock"></i> Your payment is secure and encrypted.</div>
            </div>
        </div>
    </div>
</div>
<script>
function selectMethod(el) {
    document.querySelectorAll('.method-options label').forEach(l => l.classList.remove('active'));
    el.classList.add('active');
}
</script>
<script src="../../assets/js/global.js"></script>
</body>
</html>