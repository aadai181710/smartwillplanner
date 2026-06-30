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

        .tool-card.btn-card {
            align-items: center;
            text-align: center;
            justify-content: center;
            padding: 32px 24px;
        }
        .tool-card.btn-card .tool-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            font-size: 2rem;
            margin-bottom: 18px;
        }
        .tool-card.btn-card .btn-tool {
            background: #b30707;
            color: #fff;
            border: none;
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background .2s;
            width: 100%;
            max-width: 240px;
        }
        .tool-card.btn-card .btn-tool:hover {
            background: #8f0505;
        }

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
        .affiliate-item .aff-info { flex: 1; }
        .affiliate-item .aff-info .name { font-weight: 600; font-size: .9rem; }
        .affiliate-item .aff-info .desc { font-size: .7rem; color: #6f8ea3; }
        .affiliate-item .aff-arrow { color: #8aa4bc; font-size: .8rem; }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: #fff;
            border-radius: 32px;
            padding: 30px 35px;
            max-width: 820px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 24px 60px rgba(0,0,0,0.3);
        }
        .modal-box .modal-close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: #6f8ea3;
            transition: color .2s;
        }
        .modal-box .modal-close:hover { color: #b30707; }
        .modal-box h2 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 1.4rem;
            color: #1a2c3e;
        }
        .modal-box h2 i { color: #7a3f9e; }
        .modal-btns {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .modal-btns .btn {
            padding: 8px 28px;
            border-radius: 40px;
            font-weight: 600;
            border: 0;
            cursor: pointer;
            font-size: .9rem;
        }
        .modal-btns .btn-cancel {
            background: #eef2f8;
            color: #2c4a66;
        }
        .modal-btns .btn-cancel:hover { background: #dce4ed; }
        .modal-btns .btn-save-risk {
            background: #7a3f9e;
            color: #fff;
        }
        .modal-btns .btn-save-risk:hover { background: #5f2f7a; }

        .intro-text {
            font-size: .92rem;
            color: #1a2c3e;
            margin-bottom: 18px;
            background: transparent;
            border: none;
            padding: 0;
        }
        .risk-section {
            background: #fafcfe;
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 14px;
            border: 1px solid #eef2f8;
        }
        .risk-section h3 {
            font-size: .95rem;
            color: #1a2c3e;
            margin-bottom: 10px;
            font-weight: 600;
            border-bottom: 1px dashed #e0eaf2;
            padding-bottom: 8px;
        }
        .risk-section h3 i { color: #7a3f9e; margin-right: 6px; }
        .ck-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 6px;
            padding: 3px 4px;
            font-size: .82rem;
            color: #1f3a52;
            line-height: 1.4;
        }
        .ck-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-top: 2px;
            accent-color: #7a3f9e;
            flex-shrink: 0;
            cursor: pointer;
        }
        .ck-item label { cursor: pointer; flex: 1; }
        .ck-item:hover { background: #f0f4fa; border-radius: 6px; }

        .risk-result { padding: 10px 0; }
        .risk-result .score-big {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1a2c3e;
            margin: 10px 0 5px;
        }
        .risk-result .rating {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            padding: 6px 18px;
            border-radius: 40px;
            display: inline-block;
        }
        .risk-result .rating.low { background: #e0f0e6; color: #1f7a5a; }
        .risk-result .rating.moderate { background: #fef0e0; color: #b87a1f; }
        .risk-result .rating.high { background: #fde8e8; color: #b33c3c; }
        .risk-result .description {
            background: #f8fafd;
            border-radius: 16px;
            padding: 18px 22px;
            margin-top: 15px;
            font-size: .95rem;
            line-height: 1.6;
            color: #1f3a52;
        }

        footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e0eaf2;
            text-align: center;
            font-size: .65rem;
            color: #7c9ab3;
        }

        @media (max-width: 1024px) {
            .tools-grid { grid-template-columns: repeat(2, 1fr); }
            .tool-card.btn-card { padding: 24px 18px; }
            .tool-card.btn-card .tool-icon { width: 60px; height: 60px; font-size: 1.6rem; }
            .tool-card.btn-card .btn-tool { font-size: 1rem; padding: 10px 24px; max-width: 200px; }
        }
        @media (max-width: 768px) {
            .page-header { flex-direction: column; align-items: flex-start; gap: 8px; }
            .page-header h1 { font-size: 1.3rem; }
            .page-header p { font-size: .8rem; }
            .tools-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
            .tool-card { padding: 18px 16px; }
            .tool-card .tool-icon { width: 48px; height: 48px; font-size: 1.3rem; }
            .tool-card h3 { font-size: 1rem; }
            .tool-card .tool-desc { font-size: .8rem; }
            .tool-card.btn-card { padding: 20px 16px; }
            .tool-card.btn-card .tool-icon { width: 56px; height: 56px; font-size: 1.6rem; }
            .tool-card.btn-card .btn-tool { font-size: .95rem; padding: 10px 20px; max-width: 180px; }
            .affiliate-item { padding: 8px 12px; gap: 10px; }
            .affiliate-item .aff-icon { width: 30px; height: 30px; font-size: .9rem; }
            .affiliate-item .aff-info .name { font-size: .85rem; }
            .affiliate-item .aff-info .desc { font-size: .65rem; }
            .modal-box { padding: 24px 20px; width: 95%; }
            .modal-box h2 { font-size: 1.2rem; }
            .risk-section { padding: 12px 14px; }
            .ck-item { font-size: .78rem; }
        }
        @media (max-width: 480px) {
            .tools-grid { grid-template-columns: 1fr; gap: 12px; }
            .tool-card { padding: 16px 14px; }
            .tool-card .tool-icon { width: 40px; height: 40px; font-size: 1.1rem; }
            .tool-card h3 { font-size: .95rem; }
            .tool-card .tool-desc { font-size: .75rem; }
            .tool-card.btn-card { padding: 18px 14px; }
            .tool-card.btn-card .tool-icon { width: 48px; height: 48px; font-size: 1.4rem; }
            .tool-card.btn-card .btn-tool { font-size: .9rem; padding: 8px 16px; max-width: 160px; }
            .affiliate-item { padding: 6px 10px; gap: 8px; }
            .affiliate-item .aff-icon { width: 26px; height: 26px; font-size: .8rem; }
            .affiliate-item .aff-info .name { font-size: .8rem; }
            .affiliate-item .aff-info .desc { font-size: .6rem; }
            .modal-box { padding: 18px 14px; width: 98%; border-radius: 24px; }
            .modal-box h2 { font-size: 1.1rem; }
            .modal-btns .btn { padding: 6px 18px; font-size: .8rem; }
            .risk-section { padding: 10px 12px; }
            .ck-item { font-size: .75rem; gap: 6px; }
            .ck-item input[type="checkbox"] { width: 14px; height: 14px; }
            .risk-result .score-big { font-size: 1.8rem; }
            .risk-result .rating { font-size: 1.1rem; padding: 4px 14px; }
            .risk-result .description { font-size: .85rem; padding: 14px 16px; }
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
                <div class="tool-card btn-card">
                    <div class="tool-icon blue"><i class="fas fa-calculator"></i></div>
                    <button class="btn-tool" id="fundingCalcBtn">Funding Calculator</button>
                </div>

                <div class="tool-card btn-card">
                    <div class="tool-icon orange"><i class="fas fa-clipboard-list"></i></div>
                    <button class="btn-tool" id="openRiskModal">Risk Assessment Form</button>
                </div>

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

<div class="modal-overlay" id="riskModal">
    <div class="modal-box">
        <button class="modal-close" id="closeRiskModal">&times;</button>
        <h2><i class="fas fa-clipboard-list"></i> Risk Assessment</h2>
        <div id="riskForm">
            <div class="intro-text">
                <i class="fas fa-info-circle" style="color:#7a3f9e;margin-right:8px;"></i>
                For us to serve you better, kindly tick where appropriate when any of the situations apply to you.
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-user"></i> Personal &amp; Family Circumstances</h3>
                <div class="ck-item"><input type="checkbox" id="risk_p1"><label for="risk_p1">I have no Will</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p2"><label for="risk_p2">My marital status has changed recently</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p3"><label for="risk_p3">My spouse is unfamiliar with business/financial matters</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p4"><label for="risk_p4">I am unsure who to appoint to manage my affairs after my passing</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p5"><label for="risk_p5">I have a newborn in the family</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p6"><label for="risk_p6">I have young children</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p7"><label for="risk_p7">I named my young children as beneficiaries to my insurance policies</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p8"><label for="risk_p8">I have a child with special needs</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p9"><label for="risk_p9">There is strong sibling rivalry among my children</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p10"><label for="risk_p10">I have dependents, e.g. parents or parents-in-law whom I provide for</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-shield-alt"></i> Executor, Guardian &amp; Safekeeping Issues Circumstances</h3>
                <div class="ck-item"><input type="checkbox" id="risk_e1"><label for="risk_e1">I am no longer in touch with the appointed executor</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_e2"><label for="risk_e2">I am no longer in touch with the appointed guardian</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_e3"><label for="risk_e3">I need to pass my Will to someone for safekeeping</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-chart-pie"></i> Assets &amp; Financial Complexity</h3>
                <div class="ck-item"><input type="checkbox" id="risk_a1"><label for="risk_a1">I have assets in joint names and need to understand the legal implications of such holdings</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a2"><label for="risk_a2">I engage in active management of investments or trade in a portfolio of stocks</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a3"><label for="risk_a3">I have overseas assets</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a4"><label for="risk_a4">I do not have a schedule of assets that details my assets and liabilities</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a5"><label for="risk_a5">My family would need continuity of funds while waiting for grant of probate</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-globe-asia"></i> Cross-Border Family &amp; Legal Issues</h3>
                <div class="ck-item"><input type="checkbox" id="risk_c1"><label for="risk_c1">I have family members who are permanent residents or citizens of another jurisdiction</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_c2"><label for="risk_c2">I have family members who are married to foreigners</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_c3"><label for="risk_c3">I am a Muslim or from a religious faith where my estate must be divided in a certain manner</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-briefcase"></i> Business &amp; Legacy Planning</h3>
                <div class="ck-item"><input type="checkbox" id="risk_b1"><label for="risk_b1">I wish to give a legacy to a charity but am not sure how this could be achieved</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b2"><label for="risk_b2">I work well with my business partners, but their heirs may be a problem</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b3"><label for="risk_b3">I am concerned that my business becomes fragmented if I divide it among my children</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b4"><label for="risk_b4">I am a businessman and am exposed to business risks and liabilities</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b5"><label for="risk_b5">I have properties and business interests that can provide for multi-generations or be maintained as long-term resources</label></div>
            </div>
            <div class="modal-btns">
                <button type="button" class="btn btn-cancel" onclick="closeRiskModal()">Close</button>
                <button type="button" class="btn btn-save-risk" onclick="goToCheckResult()"><i class="fas fa-save"></i> Go to Check result</button>
            </div>
        </div>
        <div id="riskResult" style="display:none;">
            <div class="risk-result">
                <h3 style="font-size:1.2rem; color:#1a2c3e; margin-bottom:5px;">WHAT'S YOUR SCORE AND WHERE DO YOU STAND?</h3>
                <div class="score-big" id="resultScore">0</div>
                <div class="rating" id="resultRating">LOW RISK</div>
                <div class="description" id="resultDesc">Your estate plan appears to be comprehensive. However, regular reviews are recommended.</div>
            </div>
            <div class="modal-btns">
                <button type="button" class="btn btn-cancel" onclick="closeRiskModal()">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    document.getElementById('fundingCalcBtn').addEventListener('click', function() {
        window.location.href = 'clients/plan/fundinggap.php';
    });

    const riskModal = document.getElementById('riskModal');
    const riskForm = document.getElementById('riskForm');
    const riskResult = document.getElementById('riskResult');

    document.getElementById('openRiskModal').addEventListener('click', function() {
        riskForm.style.display = 'block';
        riskResult.style.display = 'none';
        document.querySelectorAll('#riskForm .ck-item input[type="checkbox"]').forEach(cb => cb.checked = false);
        riskModal.classList.add('open');
    });

    document.getElementById('closeRiskModal').addEventListener('click', closeRiskModal);
    riskModal.addEventListener('click', function(e) {
        if (e.target === this) closeRiskModal();
    });

    function closeRiskModal() {
        riskModal.classList.remove('open');
        riskForm.style.display = 'block';
        riskResult.style.display = 'none';
    }
    window.closeRiskModal = closeRiskModal;

    window.goToCheckResult = function() {
        const checkboxes = document.querySelectorAll('#riskForm .ck-item input[type="checkbox"]');
        let count = 0;
        checkboxes.forEach(cb => { if(cb.checked) count++; });
        const score = count;
        let rating, ratingClass, descText;
        if (score <= 5) {
            rating = 'LOW RISK';
            ratingClass = 'low';
            descText = 'This presumes that you already have an existing Will held in proper custody.<br>It is prudent to review and update your Will periodically with your Planner to ensure it continues to reflect your current wishes and circumstances.<br>We recommend doing this at least once every two to three years, or whenever there are significant changes in your life or financial situation.';
        } else if (score <= 10) {
            rating = 'MODERATE RISK';
            ratingClass = 'moderate';
            descText = 'It appears that your current Will, if you have one, is inadequate and does not comprehensively address your estate planning objectives.<br>This issue can be rectified through a consultation with your Planner, who can help identify and address any gaps by drafting a new Will or establishing Trusts.';
        } else {
            rating = 'RISKY TO HIGH RISK';
            ratingClass = 'high';
            descText = 'Your estate affairs may be fraught with delays and disputes among your family members.<br>The distribution outcome could be unsatisfactory for certain beneficiaries.<br>There are likely to be higher costs, leakages and legal expenses in sorting out the estate.<br>There is an urgent need to address your estate affairs, and you should meet with your Planner as soon as possible.';
        }

        document.getElementById('resultScore').textContent = score + ' points';
        const ratingEl = document.getElementById('resultRating');
        ratingEl.textContent = rating;
        ratingEl.className = 'rating ' + ratingClass;
        document.getElementById('resultDesc').innerHTML = descText;

        riskForm.style.display = 'none';
        riskResult.style.display = 'block';
    };

    document.querySelectorAll('.affiliate-item').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            alert('🔗 Redirecting to ' + (this.dataset.affiliate || 'partner') + ' (demo)');
        });
    });

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