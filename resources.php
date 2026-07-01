<?php $activePage = 'resources'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Resource Center · SmartWills</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ===== 卡片网格 ===== */
        .resource-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:20px}
        .res-card{background:#fff;border-radius:18px;padding:24px 20px;border:1px solid #edf2f7;cursor:pointer;transition:.25s}
        .res-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(0,0,0,.06)}
        .res-card .icon-wrap{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:16px}
        .icon-wrap.blue{background:#e6f0fa;color:#940505}
        .icon-wrap.green{background:#e0f0e6;color:#2a9d8f}
        .icon-wrap.purple{background:#ede6f5;color:#7b4fa0}
        .icon-wrap.orange{background:#fef0e0;color:#d48c2c}
        .icon-wrap.red{background:#fde8e8;color:#b33c3c}
        .res-card h4{font-size:1.05rem;margin:0 0 4px}
        .res-card p{font-size:.85rem;color:#6f8ea3;margin:0}
        .res-card .meta{margin-top:16px;padding-top:14px;border-top:1px solid #f0f4f8;display:flex;justify-content:space-between;align-items:center}
        .res-card .badge{background:#eef3fc;color:#1f6390;font-size:.7rem;font-weight:700;padding:3px 14px;border-radius:30px}
        .badge.green{background:#e0f0e6;color:#1f7a5a}
        .badge.orange{background:#fef0e0;color:#b87a1f}
        .badge.red{background:#fde8e8;color:#b33c3c}

        .btn-primary{background:#9c061f;color:#fff;border:none;padding:8px 22px;border-radius:30px;font-weight:600;cursor:pointer}
        .btn-primary:hover{background:#1a5f8a}

        /* ===== 响应式 ===== */
        @media(max-width:1024px){.resource-grid{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:768px){
            .resource-grid{gap:16px}
            .res-card{padding:20px 16px}
            .res-card h4{font-size:1rem}
            .res-card p{font-size:.8rem}
            .res-card .icon-wrap{width:44px;height:44px;font-size:1.3rem}
            .btn-primary{padding:6px 18px;font-size:.9rem}
        }
        @media(max-width:480px){
            .resource-grid{grid-template-columns:1fr;gap:14px}
            .res-card{padding:16px 14px}
            .res-card h4{font-size:.95rem}
            .res-card p{font-size:.75rem}
            .res-card .icon-wrap{width:40px;height:40px;font-size:1.1rem}
            .btn-primary{padding:5px 14px;font-size:.8rem}
            .res-card .meta{flex-wrap:wrap;gap:6px}
        }
        @media(max-width:400px){
            .content{padding:8px 6px 0}
            .res-card{padding:14px 12px}
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
                <h1 style="margin:0;"><i class="fas fa-database"></i> Resource Center</h1>
                <button class="btn-primary" id="supportBtn"><i class="fas fa-headset"></i> Support & Ticketing</button>
            </div>

            <div class="resource-grid">
                <div class="res-card" data-resource="compliance">
                    <div class="icon-wrap blue"><i class="fas fa-shield-alt"></i></div>
                    <h4>Compliance & Guidelines</h4>
                    <p>Policies, AML, regulatory updates</p>
                    <div class="meta"><span class="badge">12 items</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
                <div class="res-card" data-resource="forms">
                    <div class="icon-wrap green"><i class="fas fa-file-alt"></i></div>
                    <h4>Forms & Documents</h4>
                    <p>Templates, contracts, disclosure forms</p>
                    <div class="meta"><span class="badge green">8 items</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
                <div class="res-card" data-resource="training">
                    <div class="icon-wrap purple"><i class="fas fa-video"></i></div>
                    <h4>Training Resources</h4>
                    <p>Videos, PPT, PDFs, brochures</p>
                    <div class="meta"><span class="badge">24 items</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
                <div class="res-card" data-resource="marketplace">
                    <div class="icon-wrap orange"><i class="fas fa-store"></i></div>
                    <h4>Shopping & Marketplace</h4>
                    <p>Suppliers, merchandise, gifts</p>
                    <div class="meta"><span class="badge orange">6 items</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
                <div class="res-card" data-resource="support">
                    <div class="icon-wrap red"><i class="fas fa-ticket-alt"></i></div>
                    <h4>Support & Ticketing</h4>
                    <p>Submit tickets, FAQ, knowledge base</p>
                    <div class="meta"><span class="badge red">3 items</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.res-card').forEach(c => {
        c.addEventListener('click', function() {
            alert('📂 Opening "' + this.querySelector('h4').textContent + '" (demo)');
        });
    });
    document.getElementById('supportBtn').addEventListener('click', function() {
        alert('🎫 Support & Ticketing (demo)');
    });
</script>
</body>
</html>