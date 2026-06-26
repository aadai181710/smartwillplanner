<?php $activePage = 'tools'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>SmartWills · Tools</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #b30a0a;
        }
        .page-header h1 i { color: #921818; }
        .page-header p {
            color: #231f1f;
            font-size: .9rem;
            margin-top: 2px;
        }

        .tools-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 16px;
        }
        .tool-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #eef2f8;
            padding: 24px 22px;
            display: flex;
            flex-direction: column;
            transition: all .2s;
        }
        .tool-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,.06);
            transform: translateY(-2px);
        }
        .tool-card .tool-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 14px;
            flex-shrink: 0;
        }
        .tool-icon.blue { background: #e6f0fa; color: #981414; }
        .tool-icon.green { background: #e0f0e6; color: #2a9d8f; }
        .tool-icon.orange { background: #fef0e0; color: #f0ad4e; }
        .tool-icon.purple { background: #ede0f5; color: #8b5cf6; }
        .tool-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f1113;
            margin-bottom: 6px;
        }
        .tool-card .tool-desc {
            color: #5a6e7c;
            font-size: .85rem;
            line-height: 1.5;
            margin-bottom: 14px;
        }
        .tool-card .tool-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .calc-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
            border-bottom: 1px solid #f0f4fa;
            font-size: .85rem;
        }
        .calc-row:last-child { border-bottom: none; }
        .calc-row .label { color: #191c1e; }
        .calc-row input {
            width: 100px;
            padding: 4px 8px;
            border-radius: 8px;
            border: 1px solid #e0eaf2;
            font-size: .8rem;
            font-family: inherit;
            outline: 0;
            text-align: right;
            background: #fafcfe;
        }
        .calc-row input:focus { border-color: #2d7fb9; }
        .calc-result {
            background: #eef3fc;
            border-radius: 12px;
            padding: 10px 14px;
            margin-top: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .calc-result .label {
            font-weight: 600;
            color: #1e466e;
            font-size: .85rem;
        }
        .calc-result .amount {
            font-size: 1.2rem;
            font-weight: 800;
            color: #750000;
        }

        .risk-items {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .risk-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 2px 0;
            font-size: .8rem;
            color: #2c4c6e;
        }
        .risk-item input[type=checkbox] {
            width: 14px;
            height: 14px;
            accent-color: #2d7fb9;
            cursor: pointer;
            flex-shrink: 0;
        }
        .risk-item label { cursor: pointer; flex: 1; }
        .risk-score-display {
            background: #eef3fc;
            border-radius: 12px;
            padding: 10px 14px;
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .risk-score-display .label {
            font-weight: 600;
            color: #1e466e;
            font-size: .85rem;
        }
        .risk-score-display .score {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1e466e;
        }
        .risk-score-display .score.low { color: #2a9d8f; }
        .risk-score-display .score.moderate { color: #f0ad4e; }
        .risk-score-display .score.high { color: #d9534f; }

        .affiliate-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .affiliate-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            background: #f8fafd;
            border-radius: 12px;
            border: 1px solid #e4ecf3;
            transition: all .2s;
            text-decoration: none;
            color: #1e466e;
            cursor: pointer;
        }
        .affiliate-item:hover {
            background: #eef3fc;
            border-color: #2d7fb9;
            transform: translateX(4px);
        }
        .affiliate-item .aff-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .aff-icon.blue { background: #e6f0fa; color: #2d7fb9; }
        .aff-icon.green { background: #e0f0e6; color: #2a9d8f; }
        .aff-icon.orange { background: #fef0e0; color: #f0ad4e; }
        .affiliate-item .aff-info { flex: 1; }
        .affiliate-item .aff-info .name { font-weight: 600; font-size: .9rem; }
        .affiliate-item .aff-info .desc { font-size: .7rem; color: #6f8ea3; }
        .affiliate-item .aff-arrow { color: #8aa4bc; font-size: .8rem; }

        footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e0eaf2;
            text-align: center;
            font-size: .65rem;
            color: #7c9ab3;
        }

        @media(max-width:1024px){ .tools-grid { grid-template-columns: 1fr 1fr; } }
        @media(max-width:850px){ .tools-grid { grid-template-columns: 1fr; } }
        @media(max-width:480px){
            .page-header { flex-direction: column; align-items: flex-start; gap: 4px; }
            .calc-row { flex-wrap: wrap; gap: 4px; }
            .calc-row input { width: 80px; }
            .tool-card { padding: 16px 18px; }
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
                <div>
                    <h1><i class="fas fa-tools"></i> Tools</h1>
                    <p>Essential tools for estate planning analysis and resource access.</p>
                </div>
            </div>

            <div class="tools-grid">
                <!-- calculator -->
                <div class="tool-card">
                    <div class="tool-icon blue"><i class="fas fa-calculator"></i></div>
                    <h3>Funding Calculator</h3>
                    <div class="tool-desc">Quickly estimate the total funding needed for your estate plan.</div>
                    <div class="tool-body">
                        <div class="calc-row">
                            <span class="label">Total Assets</span>
                            <input type="number" id="calcAssets" value="5000000" step="100000" />
                        </div>
                        <div class="calc-row">
                            <span class="label">Fee Rate</span>
                            <input type="number" id="calcRate" value="5" step="0.5" style="width:60px;" />
                            <span style="font-size:.7rem;color:#6f8ea3;">%</span>
                        </div>
                        <div class="calc-row">
                            <span class="label">Living Expenses (Monthly)</span>
                            <input type="number" id="calcLiving" value="25000" step="1000" />
                        </div>
                        <div class="calc-row">
                            <span class="label">Total Debts</span>
                            <input type="number" id="calcDebts" value="550000" step="10000" />
                        </div>
                        <div class="calc-result">
                            <span class="label">Estimated Estate Fund Needed</span>
                            <span class="amount" id="calcResult">$2,850,000</span>
                        </div>
                    </div>
                </div>

                <!-- Risk Assessment -->
                <div class="tool-card">
                    <div class="tool-icon orange"><i class="fas fa-clipboard-list"></i></div>
                    <h3>Risk Assessment Form</h3>
                    <div class="tool-desc">Quick self-assessment to identify potential gaps.</div>
                    <div class="tool-body">
                        <div class="risk-items">
                            <div class="risk-item">
                                <input type="checkbox" id="riskNoWill" />
                                <label for="riskNoWill">I have no Will</label>
                            </div>
                            <div class="risk-item">
                                <input type="checkbox" id="riskYoungChildren" />
                                <label for="riskYoungChildren">I have young children</label>
                            </div>
                            <div class="risk-item">
                                <input type="checkbox" id="riskOverseas" />
                                <label for="riskOverseas">I have overseas assets</label>
                            </div>
                            <div class="risk-item">
                                <input type="checkbox" id="riskBusiness" />
                                <label for="riskBusiness">I own a business</label>
                            </div>
                            <div class="risk-item">
                                <input type="checkbox" id="riskNoSchedule" />
                                <label for="riskNoSchedule">No asset schedule</label>
                            </div>
                        </div>
                        <div class="risk-score-display">
                            <span class="label">Risk Score</span>
                            <span class="score" id="riskScoreDisplay">0</span>
                        </div>
                    </div>
                </div>

                <!-- Affiliate Links -->
                <div class="tool-card">
                    <div class="tool-icon purple"><i class="fas fa-link"></i></div>
                    <h3>Affiliate Links</h3>
                    <div class="tool-desc">Access trusted partners for legal document preparation.</div>
                    <div class="tool-body">
                        <div class="affiliate-list">
                            <div class="affiliate-item" data-affiliate="CSPR">
                                <div class="aff-icon blue"><i class="fas fa-file-signature"></i></div>
                                <div class="aff-info"><div class="name">CSPR</div><div class="desc">Comprehensive estate planning services</div></div>
                                <div class="aff-arrow"><i class="fas fa-chevron-right"></i></div>
                            </div>
                            <div class="affiliate-item" data-affiliate="Will">
                                <div class="aff-icon green"><i class="fas fa-gavel"></i></div>
                                <div class="aff-info"><div class="name">Will Writing Service</div><div class="desc">Professional will drafting & execution</div></div>
                                <div class="aff-arrow"><i class="fas fa-chevron-right"></i></div>
                            </div>
                            <div class="affiliate-item" data-affiliate="SmartWriter">
                                <div class="aff-icon orange"><i class="fas fa-pen-fancy"></i></div>
                                <div class="aff-info"><div class="name">SmartWriter</div><div class="desc">AI-powered legal document generation</div></div>
                                <div class="aff-arrow"><i class="fas fa-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer>© 2026 smartwillsplanner.com</footer>
        </div>
    </div>
</div>

<script>
(function(){
    'use strict';

    // ========== calculator ==========
    const ca = document.getElementById('calcAssets');
    const cr = document.getElementById('calcRate');
    const cl = document.getElementById('calcLiving');
    const cd = document.getElementById('calcDebts');
    const cres = document.getElementById('calcResult');

    function updateCalc() {
        const a = parseFloat(ca.value) || 0;
        const r = parseFloat(cr.value) || 0;
        const l = parseFloat(cl.value) || 0;
        const d = parseFloat(cd.value) || 0;
        const total = a * (r / 100) + l * 12 * 5 + d;
        cres.textContent = '$' + total.toLocaleString(undefined, {minimumFractionDigits:0, maximumFractionDigits:0});
    }
    [ca, cr, cl, cd].forEach(el => el.addEventListener('input', updateCalc));
    updateCalc();

    // ========== Risk Assessment ==========
    const riskItems = [
        { id: 'riskNoWill', pts: 3 },
        { id: 'riskYoungChildren', pts: 3 },
        { id: 'riskOverseas', pts: 3 },
        { id: 'riskBusiness', pts: 3 },
        { id: 'riskNoSchedule', pts: 3 }
    ];
    const rsd = document.getElementById('riskScoreDisplay');

    function updateRisk() {
        let score = 0;
        riskItems.forEach(i => {
            const chk = document.getElementById(i.id);
            if (chk && chk.checked) score += i.pts;
        });
        rsd.textContent = score;
        rsd.className = 'score';
        if (score <= 6) rsd.classList.add('low');
        else if (score <= 12) rsd.classList.add('moderate');
        else rsd.classList.add('high');
    }
    riskItems.forEach(i => {
        const chk = document.getElementById(i.id);
        if (chk) chk.addEventListener('change', updateRisk);
    });
    updateRisk();

    // ========== Affiliate Links ==========
    document.querySelectorAll('.affiliate-item').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            alert('🔗 Redirecting to ' + (this.dataset.affiliate || 'partner') + ' (demo)');
        });
    });

    // ========== Navigation ==========
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            this.classList.add('active');
            const target = this.dataset.nav;
            const map = {
                dashboard: 'index.php',
                clients: 'clients/clients.php',
                cases: 'cases.php',
                tools: 'tools.php',
                education: 'education/dashboard.php',
                resources: 'resources.php',
                salesreport: 'salesreport.php'
            };
            if (target === 'tools') return;
            if (map[target]) window.location.href = map[target];
            else alert('🔹 Navigate to ' + (this.querySelector('span')?.innerText || target));
        });
    });

    // ========== Sidebar bottom button ==========
    document.querySelectorAll('.action-side-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.dataset.action;
            if (action === 'myprofile') alert('👤 My Profile (demo)');
            else if (action === 'settings') alert('⚙️ Settings (demo)');
            else alert('🔧 ' + (this.querySelector('span')?.innerText || action));
        });
    });
})();
</script>
</body>
</html>