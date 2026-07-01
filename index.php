<?php $activePage = 'dashboard'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>SmartWill Planner · Dashboard</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .hero-banner{background:linear-gradient(135deg,#c11010,#b01f0f);border-radius:24px;padding:28px 32px;margin-bottom:28px}
        .hero-banner h5{color:#fff;font-size:.75rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:4px}
        .hero-banner h1{font-size:1.6rem;font-weight:700;color:#fff;margin:0}
        .hero-banner p{color:#fff;margin-top:4px}
        .hero-banner .date-badge{margin-top:10px;display:inline-block;background:rgba(255,255,255,.6);padding:4px 16px;border-radius:30px;font-size:.8rem;color:#fff}

        .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px}
        .stat-card{background:#fff;border-radius:16px;padding:18px 20px;border:1px solid #eef2f8;display:flex;align-items:center;gap:14px}
        .stat-card .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
        .stat-icon.blue{background:#e6f0fa;color:#2d7fb9}
        .stat-icon.green{background:#e0f0e6;color:#2a9d8f}
        .stat-icon.orange{background:#fef0e0;color:#f0ad4e}
        .stat-icon.purple{background:#ede0f5;color:#8b5cf6}
        .stat-card .stat-number{font-size:1.4rem;font-weight:700;color:#1e466e;line-height:1.2}
        .stat-card .stat-label{font-size:.75rem;color:#6f8ea3}

        .modules-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px}
        .module-card{background:#fff;border-radius:16px;padding:20px 22px;border:1px solid #eef2f8}
        .module-card h3{font-size:1rem;font-weight:700;color:#260000;margin:0 0 10px}
        .module-card p{font-size:.8rem;color:#2f3335;margin:0}
        .module-card.recent-cases{grid-column:1/-1}
        .module-card.recent-cases .placeholder-table{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:8px;font-size:.75rem;color:#6f8ea3;margin-top:8px}
        .module-card.recent-cases .placeholder-table .header{font-weight:600;color:#1e466e}

        footer{margin-top:20px;padding-top:10px;border-top:1px solid #e0eaf2;text-align:center;font-size:.65rem;color:#7c9ab3}

        @media(max-width:1024px){.stats-grid{grid-template-columns:repeat(2,1fr)}.modules-grid{grid-template-columns:1fr}.module-card.recent-cases{grid-column:1}}
        @media(max-width:768px){
            .hero-banner{padding:20px}
            .hero-banner h1{font-size:1.3rem}
            .hero-banner p{font-size:.9rem}
            .hero-banner .date-badge{font-size:.7rem;padding:2px 12px}
            .stats-grid{grid-template-columns:1fr;gap:12px}
            .stat-card{padding:14px 16px}
            .stat-card .stat-number{font-size:1.2rem}
            .stat-card .stat-label{font-size:.7rem}
            .modules-grid{gap:12px}
            .module-card{padding:16px 18px}
            .module-card h3{font-size:.95rem}
            .module-card p{font-size:.75rem}
            .module-card.recent-cases .placeholder-table{grid-template-columns:1fr 1fr;font-size:.7rem;gap:4px 12px}
            .module-card.recent-cases .placeholder-table .header{grid-column:span 2}
            .module-card.recent-cases .placeholder-table span{padding:2px 0;border-bottom:1px solid #f0f4fa}
            .module-card.recent-cases .placeholder-table span:nth-child(n+5){border-bottom:none}
        }
        @media(max-width:480px){
            .hero-banner{padding:16px;border-radius:16px}
            .hero-banner h1{font-size:1.1rem}
            .stat-card{padding:12px 14px;gap:10px}
            .stat-card .stat-icon{width:36px;height:36px;font-size:1rem}
            .stat-card .stat-number{font-size:1rem}
            .module-card{padding:14px 16px}
            .module-card h3{font-size:.9rem}
            .module-card.recent-cases .placeholder-table{grid-template-columns:1fr;gap:2px}
            .module-card.recent-cases .placeholder-table .header{grid-column:1;margin-top:6px}
            .module-card.recent-cases .placeholder-table span{padding:2px 0;border-bottom:1px solid #f0f4fa}
            .module-card.recent-cases .placeholder-table span:last-child{border-bottom:none}
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">
            <div class="hero-banner">
                <h5>DASHBOARD</h5>
                <h1>Welcome back, Sarah 👋</h1>
                <p>Here's an overview of your estate planning portal today.</p>
                <div class="date-badge"><i class="far fa-calendar-alt"></i> <span id="realTimeDate">----Year--Month--Day</span></div>
            </div>

            <div class="stats-grid">
                <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-briefcase"></i></div><div><div class="stat-number">42</div><div class="stat-label">Active Cases</div></div></div>
                <div class="stat-card"><div class="stat-icon green"><i class="fas fa-user-plus"></i></div><div><div class="stat-number">156</div><div class="stat-label">New Clients</div></div></div>
                <div class="stat-card"><div class="stat-icon orange"><i class="fas fa-chalkboard-user"></i></div><div><div class="stat-number">12</div><div class="stat-label">Training Modules</div></div></div>
                <div class="stat-card"><div class="stat-icon purple"><i class="fas fa-dollar-sign"></i></div><div><div class="stat-number">$3,420</div><div class="stat-label">Ending Comm.</div></div></div>
            </div>

            <div class="modules-grid">
                <div class="module-card"><h3>Announcement &amp; Update</h3><p>No new announcements</p></div>
                <div class="module-card"><h3>Upcoming Events &amp; Training</h3><p>No upcoming events</p></div>
                <div class="module-card recent-cases">
                    <h3>Recent Cases</h3>
                    <p>No recent cases</p>
                    <div class="placeholder-table">
                        <span class="header">Client</span><span class="header">Product</span><span class="header">Status</span><span class="header">Date</span>
                        <span>—</span><span>—</span><span>—</span><span>—</span>
                        <span>—</span><span>—</span><span>—</span><span>—</span>
                    </div>
                </div>
            </div>

            <footer>© 2026 smartwillsplanner.com</footer>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const el = document.getElementById('realTimeDate');
    function update(){ if(el) el.innerText = new Date().toLocaleDateString('en-US', {year:'numeric', month:'long', day:'numeric'}); }
    update(); setInterval(update, 3600000);

    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            this.classList.add('active');
            const target = this.dataset.nav;
            const map = { dashboard:'index.php', clients:'clients/clients.php', cases:'cases.php', tools:'tools.php', education:'education/dashboard.php', resources:'resources.php', salesreport:'salesreport.php' };
            if (target === 'dashboard') return;
            if (map[target]) window.location.href = map[target];
            else alert('🔹 Navigate to ' + (this.querySelector('span')?.innerText || target));
        });
    });

    document.querySelectorAll('.action-side-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.dataset.action;
            if (action === 'myprofile') alert('👤 My Profile (demo)');
            else if (action === 'settings') alert('⚙️ Settings (demo)');
            else alert('🔧 ' + (this.querySelector('span')?.innerText || action));
        });
    });
});
</script>
</body>
</html>