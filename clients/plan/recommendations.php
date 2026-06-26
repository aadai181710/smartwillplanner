<?php
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = $clientId ? 'Client #' . $clientId : 'Unspecified Client';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Recommendations · SmartWills</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{background:#f2f6fb;font-family:Segoe UI,Roboto,sans-serif;padding:30px 20px;display:flex;justify-content:center}
        .wrapper{max-width:960px;width:100%;background:#fff;border-radius:32px;padding:30px 35px;box-shadow:0 12px 40px rgba(0,0,0,0.08)}
        @media(max-width:600px){.wrapper{padding:20px}}

        .header{display:flex;justify-content:space-between;flex-wrap:wrap;margin-bottom:24px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        .header h1{font-size:1.5rem;color:#1a2c3e;display:flex;align-items:center;gap:10px}
        .header h1 i{color:#b30707}
        .badge{background:#eef3f8;padding:4px 16px;border-radius:40px;font-size:.9rem;color:#1e466e}
        .total-badge{background:#eef3f8;padding:4px 16px;border-radius:40px;font-weight:700;font-size:1rem;color:#b30707}

        .product-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:30px}
        .product-card{background:#fff;border-radius:20px;border:1px solid #eef2f8;padding:20px 22px 24px;transition:.25s;display:flex;flex-direction:column}
        .product-card:hover{transform:translateY(-4px);box-shadow:0 12px 28px rgba(0,0,0,0.06);border-color:#c1d7e6}
        .product-card .price{font-weight:800;font-size:1.3rem;color:#b30707;margin-bottom:8px}
        .product-card h3{font-size:1.1rem;font-weight:700;color:#1a2c3e;margin-bottom:6px}
        .product-card .desc{font-size:.9rem;color:#4a6f8a;line-height:1.4;margin-bottom:12px;flex:1}
        .product-card .features{list-style:none;padding:0;margin:0 0 16px 0;font-size:.85rem;color:#1e466e}
        .product-card .features li{padding:4px 0 4px 20px;position:relative}
        .product-card .features li::before{content:"•";color:#b30707;font-weight:700;position:absolute;left:2px}
        .product-card .btn{padding:8px 16px;border-radius:40px;border:none;font-weight:600;font-size:.85rem;cursor:pointer;text-align:center;display:inline-block;transition:.15s;margin-top:auto;align-self:flex-start}
        .btn-primary{background:#b30707;color:#fff}
        .btn-primary:hover{background:#8f0505}
        .btn-outline{background:transparent;color:#b30707;border:1px solid #b30707}
        .btn-outline:hover{background:#fef0f0}
        .btn-secondary{background:#eef2f8;color:#2c4a66}
        .btn-secondary:hover{background:#dce4ed}

        /* Enhanced CTA banner */
        .footer-cta{
            background: linear-gradient(135deg, #b30707 0%, #7a0404 100%);
            border-radius: 24px;
            padding: 32px 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 16px;
            box-shadow: 0 8px 32px rgba(179,7,7,0.25);
            color: #fff;
            transition: box-shadow 0.3s;
        }
        .footer-cta:hover{
            box-shadow: 0 12px 40px rgba(179,7,7,0.35);
        }
        .footer-cta .text{
            font-size: 1.05rem;
            font-weight: 500;
            color: #fff;
            flex: 1 1 300px;
            line-height: 1.6;
        }
        .footer-cta .text i{
            color: #ffd700;
            margin-right: 10px;
        }
        .footer-cta .text span{
            display: block;
            font-weight: 300;
            font-size: 0.92rem;
            opacity: 0.9;
            margin-top: 6px;
        }
        .footer-cta .experts{
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            padding: 8px 22px;
            border-radius: 40px;
            font-weight: 600;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
            font-size: 0.95rem;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .footer-cta .experts i{
            color: #ffd700;
        }
        .footer-cta .btn-cta{
            padding: 12px 34px;
            border-radius: 40px;
            border: none;
            background: #fff;
            color: #b30707;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .footer-cta .btn-cta:hover{
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            background: #f8f8f8;
        }
        .footer-cta .btn-cta i{
            margin-right: 6px;
        }

        .btns{display:flex;justify-content:space-between;gap:16px;margin-top:28px;flex-wrap:wrap;border-top:1px solid #eef3f8;padding-top:20px}
        .btn{padding:8px 28px;border-radius:40px;font-weight:600;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;font-size:.95rem}
        .btn-back{background:#eef2f8;color:#2c4a66}
        .btn-back:hover{background:#dce4ed}
        .btn-next{background:#b30707;color:#fff}
        .btn-next:hover{background:#8f0505}

        @media(max-width:700px){
            .product-grid{grid-template-columns:1fr 1fr}
            .footer-cta{flex-direction:column;align-items:stretch;text-align:center;padding:28px 24px}
            .footer-cta .experts{align-self:center}
            .btns{flex-direction:column;align-items:stretch}
            .btn{justify-content:center}
        }
        @media(max-width:500px){.product-grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    <div class="header">
        <h1><i class="fas fa-gem"></i> Product Recommendations</h1>
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <span class="total-badge"><i class="fas fa-tag"></i> $1,200</span>
        </div>
    </div>

    <!-- Product cards -->
    <div class="product-grid">
        <!-- 1 -->
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
        <!-- 2 -->
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
        <!-- 3 -->
        <div class="product-card">
            <div class="price">Custom</div>
            <h3>SmartCare Trust</h3>
            <div class="desc">An advanced trust structure designed for high-value asset protection and seamless generational wealth transfer.</div>
            <ul class="features">
                <li>Probate Avoidance</li>
                <li>Tax Optimization Layer</li>
                <li>Creditor Protection</li>
            </ul>
            <button class="btn btn-outline">Inquire for Custom Quote</button>
        </div>
        <!-- 4 -->
        <div class="product-card">
            <div class="price">Included</div>
            <h3>AMD (Advanced)</h3>
            <div class="desc">Ensure your healthcare preferences are honored in terminal situations. A critical companion to the Personal Will.</div>
            <ul class="features">
                <li>Life-Sustaining Treatment Logic</li>
                <li>Palliative Care Priorities</li>
                <li>Legal Clarity for Physicians</li>
            </ul>
            <button class="btn btn-secondary">Include in Plan</button>
        </div>
    </div>

    <!-- Enhanced CTA banner -->
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

    <!-- Navigation buttons -->
    <div class="btns">
        <a href="fundinggap.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Funding Gap</a>
        <a href="payment.php?id=<?=$clientId?>" class="btn btn-next">Go to Payment <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
</body>
</html>