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
    <title>Funding Gap Â· SmartWills</title>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/topbar.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
    <link rel="stylesheet" href="../../assets/css/fundinggap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="wrapper">
    <?php include '../../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../../layouts/topbar.php'; ?>
        <div class="content">
            <div class="funding-wrapper">
                <!-- è¿›åº¦æ¡ -->
                <div class="progress-steps">
                    <div class="step"><span class="circle">1</span><span class="label">My Assets</span></div>
                    <div class="step"><span class="circle">2</span><span class="label">Estate Planning Checklist</span></div>
                    <div class="step"><span class="circle">3</span><span class="label">Estate Fund Need Analysis</span></div>
                    <div class="step active"><span class="circle">4</span><span class="label">Funding Gap</span></div>
                    <div class="step"><span class="circle">5</span><span class="label">Product Recommendations</span></div>
                    <div class="step"><span class="circle">6</span><span class="label">Payment</span></div>
                </div>

                <div class="header">
                    <h1><i class="fas fa-calculator"></i> Funding Gap</h1>
                    <div class="client-info">
                        <span class="avatar"><?php echo strtoupper(substr(trim($clientName), 0, 1)); ?></span>
                        <span class="client-name-text"><?php echo htmlspecialchars($clientName); ?></span>
                    </div>
                </div>

                <form method="POST" action="recommendations.php?id=<?=$clientId?>">
                    <input type="hidden" name="client_id" value="<?=$clientId?>">

                    <!-- Part 1: Movable Funds -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-money-bill-wave"></i> Part 1: Movable Funds</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <div class="row"><label>1. Cash In The Bank</label><input type="number" id="cash" value="20000" step="100" oninput="calc()"><span class="val" id="cashDisp">$ 20,000</span></div>
                            <div class="row"><label>2. Unit Trust or Investments</label><input type="number" id="invest" value="200000" step="100" oninput="calc()"><span class="val" id="investDisp">$ 200,000</span></div>
                            <div class="row"><label>3. Retirement Fund</label><input type="number" id="retire" value="500000" step="100" oninput="calc()"><span class="val" id="retireDisp">$ 500,000</span></div>
                        </div>
                    </div>

                    <!-- Part 2: Insurance Policies -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-shield-alt"></i> Part 2: Insurance Policies</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <div class="row">
                                <label>Do you have insurance policy?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="has_insurance" value="Yes" checked onchange="togglePolicies()"> Yes</label>
                                    <label><input type="radio" name="has_insurance" value="No" onchange="togglePolicies()"> No</label>
                                </div>
                            </div>
                            <div id="policiesWrap">
                                <div id="policiesList"></div>
                                <button type="button" class="btn-sm btn-add" onclick="addPolicy()"><i class="fas fa-plus"></i> Add Insurance Policy</button>
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="insurance-summary-title">Summary of existing insurance coverage</div>
                    <div id="summaryList"></div>

                    <div class="funding-summary-block">
                        <div class="summary-item"><span class="lbl">1. Cash In The Bank</span><span class="val" id="sCash">$ 20,000</span></div>
                        <div class="summary-item"><span class="lbl">2. Unit Trust or Investments</span><span class="val" id="sInvest">$ 200,000</span></div>
                        <div class="summary-item"><span class="lbl">3. Retirement Fund</span><span class="val" id="sRetire">$ 500,000</span></div>
                        <div class="summary-item"><span class="lbl">4. Total Insurance Coverage</span><span class="val" id="sInsurance">$ 1,500,000</span></div>
                        <div class="total-row"><span>Total Amount of Movable Funds:</span><span class="val" id="totalMovable">$ 2,220,000</span></div>
                        <div class="total-row"><span>Total Amount of Estate Fund Needed:</span><span class="val">$ 3,000,000</span></div>
                        <div class="total-row" id="surplusRow"><span>Surplus / Deficit</span><span class="val" id="surplusVal">$ 780,000</span></div>
                    </div>

                    <input type="hidden" name="total_movable" id="totalMovableHidden">
                    <input type="hidden" name="insurance_total" id="insuranceTotalHidden">

                    <div class="btns">
                        <a href="epchecklist.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Checklist</a>
                        <button type="submit" class="btn btn-next">Save & Continue <i class="fas fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAccordion(header) {
    const body = header.nextElementSibling;
    const arrow = header.querySelector('.arrow');
    const isOpen = body.classList.contains('open');
    isOpen ? (body.classList.remove('open'), arrow.classList.remove('open')) : (body.classList.add('open'), arrow.classList.add('open'));
}

let policyCount = 0;
const planTypes = ['Investment Link','Whole Life','Universal Life','Term Life','Personal Accident','Medical & Hospitalization','Endowment'];

function addPolicy(data) {
    policyCount++;
    const id = policyCount;
    const d = data || { company:'', policy:'', premium:'', plan:'', life:'', ci:'', term:'', pa:'' };
    const div = document.createElement('div');
    div.className = 'policy-box';
    div.id = 'policy_'+id;
    div.innerHTML = `
        <div class="policy-header">
            <strong>[${String.fromCharCode(64+policyCount)}] Insurance Company</strong>
            <button type="button" class="btn-sm btn-remove" onclick="removePolicy(${id})"><i class="fas fa-trash"></i> Remove</button>
        </div>
        <div class="row"><label>Company Name</label><input type="text" class="pCompany" value="${d.company}" placeholder="e.g. Prudential" oninput="calc()"></div>
        <div class="row"><label>Policy Number (optional)</label><input type="text" class="pPolicy" value="${d.policy}" placeholder="optional" oninput="calc()"></div>
        <div class="row"><label>Annual Premium</label><input type="number" class="pPremium" value="${d.premium||''}" step="100" placeholder="$" oninput="calc()"></div>
        <div class="row"><label>Type of Insurance Plan *</label>
            <select class="pPlan" onchange="calc()">${planTypes.map(t=>`<option value="${t}" ${t===d.plan?'selected':''}>${t}</option>`).join('')}</select>
        </div>
        <div class="row"><label>Life (optional)</label><input type="number" class="pLife" value="${d.life||''}" step="1000" placeholder="$" oninput="calc()"></div>
        <div class="row"><label>Critical Illness (optional)</label><input type="number" class="pCI" value="${d.ci||''}" step="1000" placeholder="$" oninput="calc()"></div>
        <div class="row"><label>Term Insurance (optional)</label><input type="number" class="pTerm" value="${d.term||''}" step="1000" placeholder="$" oninput="calc()"></div>
        <div class="row"><label>Personal Accident (optional)</label><input type="number" class="pPA" value="${d.pa||''}" step="1000" placeholder="$" oninput="calc()"></div>
    `;
    document.getElementById('policiesList').appendChild(div);
    calc();
}

function removePolicy(id) {
    document.getElementById('policy_'+id).remove();
    calc();
}

function togglePolicies() {
    const show = document.querySelector('input[name="has_insurance"]:checked').value === 'Yes';
    document.getElementById('policiesWrap').style.display = show ? 'block' : 'none';
    if (!show) document.getElementById('policiesList').innerHTML = '';
    calc();
}

function calc() {
    let cash = parseFloat(document.getElementById('cash').value)||0;
    let invest = parseFloat(document.getElementById('invest').value)||0;
    let retire = parseFloat(document.getElementById('retire').value)||0;
    document.getElementById('cashDisp').textContent = '$ '+cash.toLocaleString();
    document.getElementById('investDisp').textContent = '$ '+invest.toLocaleString();
    document.getElementById('retireDisp').textContent = '$ '+retire.toLocaleString();
    document.getElementById('sCash').textContent = '$ '+cash.toLocaleString();
    document.getElementById('sInvest').textContent = '$ '+invest.toLocaleString();
    document.getElementById('sRetire').textContent = '$ '+retire.toLocaleString();

    let totalIns = 0;
    let summaryHTML = '';
    const boxes = document.querySelectorAll('.policy-box');
    let idx = 0;
    boxes.forEach(box => {
        const company = box.querySelector('.pCompany').value || 'Unnamed';
        const life = parseFloat(box.querySelector('.pLife').value)||0;
        totalIns += life;
        idx++;
        summaryHTML += `<div class="summary-item"><span class="lbl">[${String.fromCharCode(64+idx)}] ${company}</span><span class="val">$ ${life.toLocaleString()}</span></div>`;
    });
    document.getElementById('summaryList').innerHTML = summaryHTML || '<div class="empty-summary">No insurance policies added.</div>';
    document.getElementById('sInsurance').textContent = '$ '+totalIns.toLocaleString();

    let totalMovable = cash + invest + retire + totalIns;
    let estateNeed = 3000000;
    let surplus = totalMovable - estateNeed;
    document.getElementById('totalMovable').textContent = '$ '+totalMovable.toLocaleString();
    document.getElementById('totalMovableHidden').value = totalMovable;
    document.getElementById('insuranceTotalHidden').value = totalIns;
    const surplusEl = document.getElementById('surplusVal');
    surplusEl.textContent = '$ '+surplus.toLocaleString();
    surplusEl.className = 'val ' + (surplus >= 0 ? 'surplus' : 'deficit');
    document.getElementById('surplusRow').querySelector('span:first-child').textContent = surplus >= 0 ? 'Surplus' : 'Deficit';
}

document.addEventListener('DOMContentLoaded', function() {
    addPolicy({company:'Prudential', plan:'Whole Life', life:500000});
    addPolicy({company:'Manulife', plan:'Term Life', term:1000000, ci:200000});
    addPolicy({});
    calc();
});
</script>
<script src="../../assets/js/global.js"></script>
</body>
</html>

