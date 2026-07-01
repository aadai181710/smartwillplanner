<?php
$activePage = 'clients';
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = 'Zhang Wei';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Product Recommendations · SmartWills</title>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* 基础布局 */
        html,body{height:100%;margin:0}
        .wrapper{display:flex;height:100vh;overflow:hidden}
        .sidebar{position:fixed;top:0;left:0;height:100vh;width:250px;overflow-y:auto;z-index:1000;background:#fff;border-right:1px solid #eef2f8}
        .main-content{margin-left:250px;display:flex;flex-direction:column;height:100vh;overflow:hidden;flex:1}
        .topbar{position:sticky;top:0;z-index:999;background:#fff;border-bottom:1px solid #eef2f8}
        .content{flex:1;overflow-y:auto;padding:20px 20px 0}
        .rec-wrapper{width:100%;background:#fff;border-radius:32px;box-shadow:0 12px 40px rgba(0,0,0,0.08);padding:24px 30px 30px}

        /* 进度条 */
        .progress-steps{display:flex;align-items:flex-start;justify-content:space-between;position:relative;margin-bottom:28px;padding:0 6px}
        .progress-steps::before{content:'';position:absolute;top:22px;left:0;right:0;height:2px;background:#e0e8ef;z-index:0}
        .step{display:flex;flex-direction:column;align-items:center;flex:1;position:relative;z-index:1;text-align:center}
        .step .circle{width:44px;height:44px;border-radius:50%;background:#e0e8ef;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;transition:background .2s;flex-shrink:0}
        .step.active .circle{background:#b30707;box-shadow:0 4px 10px rgba(179,7,7,0.25)}
        .step .label{margin-top:8px;font-size:.75rem;color:#7a93ab;font-weight:500;line-height:1.2;max-width:90px;word-break:break-word}
        .step.active .label{color:#b30707;font-weight:700}

        /* 头部 */
        .header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;margin-bottom:24px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        .header h1{font-size:1.5rem;color:#1a2c3e;display:flex;align-items:center;gap:10px}
        .header h1 i{color:#b30707}
        .header .client-info{display:flex;align-items:center;gap:12px}
        .header .client-info .avatar{width:44px;height:44px;border-radius:50%;background:#e6f0fa;color:#2d7fb9;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.1rem;text-transform:uppercase;flex-shrink:0}
        .header .client-info .client-name-text{font-weight:600;color:#1e466e;font-size:1.05rem}

        /* 产品卡片 */
        .product-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:30px}
        .product-card{background:#fff;border-radius:20px;border:1px solid #eef2f8;padding:20px 22px 24px;display:flex;flex-direction:column;transition:.25s}
        .product-card:hover{transform:translateY(-4px);box-shadow:0 12px 28px rgba(0,0,0,0.06);border-color:#c1d7e6}
        .product-card .price{font-weight:800;font-size:1.3rem;color:#b30707;margin-bottom:8px}
        .product-card h3{font-size:1.1rem;font-weight:700;color:#1a2c3e;margin-bottom:6px}
        .product-card .desc{font-size:.9rem;color:#4a6f8a;line-height:1.4;margin-bottom:12px;flex:1}
        .product-card .features{list-style:none;padding:0;margin:0 0 16px 0;font-size:.85rem;color:#1e466e}
        .product-card .features li{padding:4px 0 4px 20px;position:relative}
        .product-card .features li::before{content:"•";color:#b30707;font-weight:700;position:absolute;left:2px}
        .product-card .btn{padding:8px 16px;border-radius:40px;border:none;font-weight:600;font-size:.85rem;cursor:pointer;display:inline-block;transition:.15s;margin-top:auto;align-self:flex-start}
        .btn-primary{background:#b30707;color:#fff}
        .btn-primary:hover{background:#8f0505}
        .btn-outline{background:transparent;color:#b30707;border:1px solid #b30707}
        .btn-outline:hover{background:#fef0f0}
        .btn-secondary{background:#eef2f8;color:#2c4a66}
        .btn-secondary:hover{background:#dce4ed}

        /* 底部CTA */
        .footer-cta{background:linear-gradient(135deg,#b30707 0%,#7a0404 100%);border-radius:24px;padding:32px 36px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:20px;margin-top:16px;color:#fff;box-shadow:0 8px 32px rgba(179,7,7,0.25)}
        .footer-cta:hover{box-shadow:0 12px 40px rgba(179,7,7,0.35)}
        .footer-cta .text{font-size:1.05rem;font-weight:500;color:#fff;flex:1 1 300px;line-height:1.6}
        .footer-cta .text i{color:#ffd700;margin-right:10px}
        .footer-cta .text span{display:block;font-weight:300;font-size:.92rem;opacity:.9;margin-top:6px}
        .footer-cta .experts{background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);padding:8px 22px;border-radius:40px;font-weight:600;color:#fff;border:1px solid rgba(255,255,255,0.2);font-size:.95rem;white-space:nowrap;display:inline-flex;align-items:center;gap:8px}
        .footer-cta .experts i{color:#ffd700}
        .footer-cta .btn-cta{padding:12px 34px;border-radius:40px;border:none;background:#fff;color:#b30707;font-weight:700;font-size:1rem;cursor:pointer;transition:all .2s;box-shadow:0 4px 12px rgba(0,0,0,0.1)}
        .footer-cta .btn-cta:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,0.2);background:#f8f8f8}
        .footer-cta .btn-cta i{margin-right:6px}

        /* 底部按钮 */
        .btns{display:flex;justify-content:space-between;gap:16px;margin-top:28px;flex-wrap:wrap;border-top:1px solid #eef3f8;padding-top:20px}
        .btn{padding:8px 28px;border-radius:40px;font-weight:600;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;font-size:.95rem}
        .btn-back{background:#eef2f8;color:#2c4a66}
        .btn-back:hover{background:#dce4ed}
        .btn-next{background:#b30707;color:#fff}
        .btn-next:hover{background:#8f0505}

        /* ===== 响应式 ===== */
        @media(max-width:1024px){
            .rec-wrapper{padding:20px 24px 24px}
            .step .circle{width:38px;height:38px;font-size:.85rem}
            .step .label{font-size:.65rem;max-width:72px}
            .progress-steps::before{top:19px}
            .header h1{font-size:1.3rem}
        }
        @media(max-width:768px){
            .sidebar{width:200px}
            .main-content{margin-left:200px}
            .rec-wrapper{padding:16px 18px 20px;border-radius:24px}
            .progress-steps{margin-bottom:20px;padding:0;flex-wrap:nowrap;overflow-x:auto;gap:4px}
            .progress-steps::before{top:16px;left:10px;right:10px}
            .step{flex:0 0 auto;min-width:50px}
            .step .circle{width:32px;height:32px;font-size:.7rem}
            .step .label{font-size:.55rem;max-width:52px;margin-top:4px}
            .header{flex-direction:column;align-items:flex-start;gap:10px;padding-bottom:12px;margin-bottom:18px}
            .header h1{font-size:1.2rem}
            .header .client-info .avatar{width:36px;height:36px;font-size:.9rem}
            .header .client-info .client-name-text{font-size:.95rem}
            .product-grid{grid-template-columns:1fr 1fr;gap:14px}
            .product-card{padding:16px 18px 20px}
            .product-card .price{font-size:1.1rem}
            .product-card h3{font-size:1rem}
            .product-card .desc{font-size:.85rem}
            .product-card .features{font-size:.8rem}
            .product-card .btn{font-size:.8rem;padding:6px 14px}
            .footer-cta{flex-direction:column;align-items:stretch;text-align:center;padding:24px 20px}
            .footer-cta .experts{align-self:center}
            .footer-cta .text{font-size:.95rem}
            .footer-cta .btn-cta{padding:10px 28px;font-size:.9rem}
            .btns{flex-direction:column;align-items:stretch}
            .btn{justify-content:center;padding:10px 20px;font-size:.9rem}
        }
        @media(max-width:480px){
            .sidebar{width:170px}
            .main-content{margin-left:170px}
            .content{padding:12px 10px 0}
            .rec-wrapper{padding:12px 14px 16px;border-radius:20px}
            .progress-steps{margin-bottom:16px}
            .step .circle{width:26px;height:26px;font-size:.6rem}
            .step .label{font-size:.45rem;max-width:40px}
            .progress-steps::before{top:13px}
            .header h1{font-size:1rem;gap:6px}
            .header .client-info .avatar{width:30px;height:30px;font-size:.75rem}
            .header .client-info .client-name-text{font-size:.85rem}
            .product-grid{grid-template-columns:1fr;gap:12px}
            .product-card{padding:14px 16px 18px}
            .product-card .price{font-size:1rem}
            .product-card h3{font-size:.95rem}
            .product-card .desc{font-size:.8rem}
            .product-card .features{font-size:.75rem}
            .product-card .features li{padding:3px 0 3px 18px}
            .product-card .btn{font-size:.75rem;padding:5px 12px}
            .footer-cta{padding:20px 16px;border-radius:18px}
            .footer-cta .text{font-size:.85rem}
            .footer-cta .text span{font-size:.8rem}
            .footer-cta .experts{font-size:.8rem;padding:6px 16px}
            .footer-cta .btn-cta{padding:8px 20px;font-size:.8rem}
            .btn{padding:8px 16px;font-size:.8rem;gap:6px}
            .btns{gap:10px;margin-top:20px;padding-top:16px}
        }
        @media(max-width:400px){
            .sidebar{width:140px}
            .main-content{margin-left:140px}
            .content{padding:8px 6px 0}
            .rec-wrapper{padding:10px 10px 14px;border-radius:16px}
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../../layouts/topbar.php'; ?>
        <div class="content">
            <div class="rec-wrapper">
                <!-- 进度条 -->
                <div class="progress-steps">
                    <div class="step"><span class="circle">1</span><span class="label">My Assets</span></div>
                    <div class="step"><span class="circle">2</span><span class="label">Estate Planning Checklist</span></div>
                    <div class="step"><span class="circle">3</span><span class="label">Estate Fund Need Analysis</span></div>
                    <div class="step"><span class="circle">4</span><span class="label">Funding Gap</span></div>
                    <div class="step active"><span class="circle">5</span><span class="label">Product Recommendations</span></div>
                    <div class="step"><span class="circle">6</span><span class="label">Payment</span></div>
                </div>

                <div class="header">
                    <h1><i class="fas fa-gem"></i> Product Recommendations</h1>
                    <div class="client-info">
                        <span class="avatar"><?php echo strtoupper(substr(trim($clientName), 0, 1)); ?></span>
                        <span class="client-name-text"><?php echo htmlspecialchars($clientName); ?></span>
                    </div>
                </div>

                <div class="product-grid">
                    <div class="product-card">
                        <div class="price">$1,200</div>
                        <h3>Comprehensive Last Will &amp; Testament</h3>
                        <div class="desc">A foundational document ensuring your assets are distributed exactly as you intend, protecting your heirs from legal complexity.</div>
                        <ul class="features">
                            <li>Asset Allocation Strategy</li>
                            <li>Guardianship Appointments</li>
                            <li>Executor Powers Definition</li>
                        </ul>
                        <button class="btn btn-primary">Add to Planning Cart</button>
                    </div>
                    <div class="product-card">
                        <div class="price">—</div>
                        <h3>LPA Form 1</h3>
                        <div class="desc">Lasting Power of Attorney (Personal Welfare &amp; Property). Nominate trusted individuals to manage affairs if you lose capacity.</div>
                        <ul class="features">
                            <li>Medical Decision Mandate</li>
                            <li>Financial Transaction Rights</li>
                            <li>Donor Preference Clauses</li>
                        </ul>
                        <button class="btn btn-primary">Add to Planning Cart</button>
                    </div>
                    <div class="product-card">
                        <div class="price">Custom</div>
                        <h3>SmartCare Trust</h3>
                        <div class="desc">An advanced trust structure designed for high-value asset protection and seamless generational wealth transfer.</div>
                        <ul class="features">
                            <li>Probate Avoidance</li>
                            <li>Tax Optimization Layer</li>
                            <li>Creditor Protection</li>
                        </ul>
                        <button class="btn btn-primary">Inquire for Custom Quote</button>
                    </div>
                    <div class="product-card">
                        <div class="price">Included</div>
                        <h3>AMD (Advanced)</h3>
                        <div class="desc">Ensure your healthcare preferences are honored in terminal situations. A critical companion to the Personal Will.</div>
                        <ul class="features">
                            <li>Life-Sustaining Treatment Logic</li>
                            <li>Palliative Care Priorities</li>
                            <li>Legal Clarity for Physicians</li>
                        </ul>
                        <button class="btn btn-primary">Include in Plan</button>
                    </div>
                </div>

                <div class="footer-cta">
                    <div class="text">
                        <i class="fas fa-shield-alt"></i>
                        Secure Your Family's Tomorrow, Today.
                        <span>Our legal advisors are standing by to review your selections and ensure absolute compliance with current estate laws.</span>
                    </div>
                    <div class="experts">
                        <i class="fas fa-user-check"></i> 12+ Experts Available for Review
                    </div>
                    <button class="btn-cta"><i class="fas fa-phone-alt"></i> Get Free Consultation</button>
                </div>

                <div class="btns">
                    <a href="fundinggap.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Funding Gap</a>
                    <a href="payment.php?id=<?=$clientId?>" class="btn btn-next">Go to Payment <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>