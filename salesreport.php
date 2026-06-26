<?php $activePage = 'salesreport'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report · SmartWills</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            border: 1px solid #eef2f8;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .stat-card .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .stat-icon.green { background: #e0f0e6; color: #2a9d8f; }
        .stat-icon.blue { background: #e6f0fa; color: #2d7fb9; }
        .stat-icon.orange { background: #fef0e0; color: #d48c2c; }
        .stat-icon.purple { background: #ede6f5; color: #7b4fa0; }
        .stat-card .stat-info { flex: 1; }
        .stat-card .stat-number { font-size: 1.5rem; font-weight: 700; color: #1e466e; line-height: 1.2; }
        .stat-card .stat-label { font-size: .75rem; color: #1f1f1f; }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        .report-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px 20px;
            border: 1px solid #edf2f7;
            cursor: pointer;
            transition: 0.25s;
        }
        .report-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.06);
        }
        .report-card .icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 16px;
        }
        .icon-wrap.green { background: #e0f0e6; color: #2a9d8f; }
        .icon-wrap.blue { background: #e6f0fa; color: #2d7fb9; }
        .icon-wrap.orange { background: #fef0e0; color: #d48c2c; }
        .icon-wrap.purple { background: #ede6f5; color: #7b4fa0; }
        .icon-wrap.red { background: #fde8e8; color: #b33c3c; }
        .report-card h4 { font-size: 1.05rem; margin-bottom: 4px; }
        .report-card p { font-size: .85rem; color: #151515; }
        .report-card .meta {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #f0f4f8;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .report-card .badge {
            background: #eef3fc;
            color: #2c2c2c;
            font-size: .7rem;
            font-weight: 700;
            padding: 3px 14px;
            border-radius: 30px;
        }
        .badge.green { background: #e0f0e6; color: #1f7a5a; }
        .badge.orange { background: #fef0e0; color: #b87a1f; }
        .badge.red { background: #fde8e8; color: #b33c3c; }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #9a0808;
        }
        .date-range {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .85rem;
        }
        .date-range select {
            padding: 6px 14px;
            border-radius: 30px;
            border: 1px solid #e0eaf2;
            background: #fff;
            font-size: .85rem;
            outline: none;
            cursor: pointer;
        }
        .btn-outline {
            background: transparent;
            color: #870000;
            border: 1px solid #730000;
            padding: 6px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-outline:hover {
            background: #e6f0fa;
        }
        .btn-primary {
            background: #2d7fb9;
            color: #fff;
            border: none;
            padding: 6px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #1a5f8a;
        }

        @media(max-width:850px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .report-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media(max-width:480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .report-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">
            <div class="page-header">
                <h1><i class="fas fa-chart-line"></i> Sales Report</h1>
                <div class="date-range">
                    <i class="fas fa-calendar-alt"></i>
                    <select id="dateRangeSelect">
                        <option value="this_month">This Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="this_quarter">This Quarter</option>
                        <option value="this_year">This Year</option>
                    </select>
                    <button class="btn-outline" id="exportBtn"><i class="fas fa-download"></i> Export</button>
                </div>
            </div>

            <!-- Statistical cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                    <div class="stat-info">
                        <div class="stat-number">$124,580</div>
                        <div class="stat-label">Total Commission</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-file-invoice"></i></div>
                    <div class="stat-info">
                        <div class="stat-number">47</div>
                        <div class="stat-label">Closed Deals</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-user-check"></i></div>
                    <div class="stat-info">
                        <div class="stat-number">32</div>
                        <div class="stat-label">Active Clients</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple"><i class="fas fa-trophy"></i></div>
                    <div class="stat-info">
                        <div class="stat-number">#2</div>
                        <div class="stat-label">Ranking</div>
                    </div>
                </div>
            </div>

            <!-- Report cards -->
            <div class="report-grid">
                <div class="report-card" data-report="commission">
                    <div class="icon-wrap green"><i class="fas fa-file-invoice-dollar"></i></div>
                    <h4>Commission Statement</h4>
                    <p>Detailed breakdown of commissions earned per deal, with payment status and history.</p>
                    <div class="meta"><span class="badge green">12 statements</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
                <div class="report-card" data-report="performance">
                    <div class="icon-wrap blue"><i class="fas fa-chart-bar"></i></div>
                    <h4>Performance Reports</h4>
                    <p>Track monthly & quarterly KPIs, conversion rates, and overall sales performance.</p>
                    <div class="meta"><span class="badge">8 reports</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
                <div class="report-card" data-report="payout">
                    <div class="icon-wrap purple"><i class="fas fa-wallet"></i></div>
                    <h4>Payout History</h4>
                    <p>Complete record of commission payouts, dates, and bank transaction references.</p>
                    <div class="meta"><span class="badge">18 entries</span><i class="fas fa-arrow-right" style="color:#b0c8dd;"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.report-card').forEach(card => {
        card.addEventListener('click', function() {
            alert('📊 Opening "' + this.querySelector('h4').innerText + '" (demo)');
        });
    });
    document.getElementById('exportBtn').addEventListener('click', function() {
        alert('📥 Exporting report as CSV (demo)');
    });
    document.getElementById('dateRangeSelect').addEventListener('change', function() {
        const labels = {
            'this_month': 'This Month',
            'last_month': 'Last Month',
            'this_quarter': 'This Quarter',
            'this_year': 'This Year'
        };
        alert('📅 Filter: ' + (labels[this.value] || this.value) + ' (demo)');
    });
</script>
</body>
</html>