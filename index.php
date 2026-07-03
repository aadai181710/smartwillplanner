<?php $activePage = 'dashboard'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>SmartWill Planner · Dashboard</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-briefcase"></i></div>
                    <div>
                        <div class="stat-number">42</div>
                        <div class="stat-label">Active Cases</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-user-plus"></i></div>
                    <div>
                        <div class="stat-number">156</div>
                        <div class="stat-label">New Clients</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-chalkboard-user"></i></div>
                    <div>
                        <div class="stat-number">12</div>
                        <div class="stat-label">Training Modules</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple"><i class="fas fa-dollar-sign"></i></div>
                    <div>
                        <div class="stat-number">$3,420</div>
                        <div class="stat-label">Ending Comm.</div>
                    </div>
                </div>
            </div>

            <div class="modules-grid">
                <div class="module-card">
                    <h3>Announcement & Update</h3>
                    <p>No new announcements</p>
                </div>
                <div class="module-card">
                    <h3>Upcoming Events & Training</h3>
                    <p>No upcoming events</p>
                </div>
                <div class="module-card recent-cases">
                    <h3>Recent Cases</h3>
                    <p>No recent cases</p>
                    <div class="placeholder-table">
                        <span class="header">Client</span>
                        <span class="header">Product</span>
                        <span class="header">Status</span>
                        <span class="header">Date</span>
                        <span>—</span>
                        <span>—</span>
                        <span>—</span>
                        <span>—</span>
                        <span>—</span>
                        <span>—</span>
                        <span>—</span>
                        <span>—</span>
                    </div>
                </div>
            </div>

            <footer>© 2026 smartwillsplanner.com</footer>
        </div>
    </div>
</div>

<script src="assets/js/global.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const el = document.getElementById('realTimeDate');
    function update() {
        if (el) {
            el.innerText = new Date().toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
    }
    update();
    setInterval(update, 3600000);
});
</script>
</body>
</html>