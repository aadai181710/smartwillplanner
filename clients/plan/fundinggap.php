<?php
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = $clientId ? 'Client #' . $clientId : 'Unspecified Client';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funding Gap · SmartWills</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{background:#f2f6fb;font-family:Segoe UI,Roboto,sans-serif;padding:30px 20px;display:flex;justify-content:center}
        .wrapper{max-width:900px;width:100%;background:#fff;border-radius:32px;padding:30px 35px;box-shadow:0 12px 40px rgba(0,0,0,0.08)}
        @media(max-width:600px){.wrapper{padding:20px}}
        .header{display:flex;justify-content:space-between;flex-wrap:wrap;margin-bottom:24px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        .header h1{font-size:1.5rem;color:#1a2c3e;display:flex;align-items:center;gap:10px}
        .header h1 i{color:#b30707}
        .badge{background:#eef3f8;padding:4px 16px;border-radius:40px;font-size:.9rem;color:#1e466e}

        .part-title{margin:28px 0 16px}
        .part-title .text{font-weight:900;font-size:1.5rem;color:#000}

        .row{display:flex;align-items:center;gap:12px;margin-bottom:10px;flex-wrap:wrap}
        .row label{font-weight:500;color:#0f3b5c;width:150px;flex-shrink:0;font-size:.9rem}
        .row input,.row select{flex:1;min-width:140px;padding:6px 12px;border:1px solid #d0dce8;border-radius:30px;font-size:.9rem;outline:none}
        .row input:focus,.row select:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .row .val{font-weight:600;color:#1e466e;width:110px;text-align:right;flex-shrink:0;font-size:.9rem}

        .policy-box{background:#f8fafd;border-radius:16px;padding:16px 20px;margin-bottom:16px;border:1px solid #eef3f8}
        .policy-box .row label{width:130px;font-size:.85rem}
        .policy-box .row input,.policy-box .row select{font-size:.85rem;padding:5px 10px;min-width:100px}

        .btn-sm{padding:4px 16px;border-radius:30px;border:none;font-weight:600;cursor:pointer;font-size:.8rem}
        .btn-add{background:#b30707;color:#fff}
        .btn-add:hover{background:#8f0505}
        .btn-remove{background:#eef2f8;color:#2c4a66}
        .btn-remove:hover{background:#dce4ed}
        .btn-pdf{background:#1a2c3e;color:#fff;padding:6px 18px;border-radius:30px;border:none;cursor:pointer;font-weight:600;font-size:.8rem;text-decoration:none;display:inline-flex;align-items:center;gap:6px}
        .btn-pdf:hover{background:#0f1f2e}

        .summary-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin:12px 0}
        .summary-item{display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px dashed #e6edf4}
        .summary-item .lbl{color:#0f3b5c}
        .summary-item .val{font-weight:600;color:#1e466e}

        .total-row{display:flex;justify-content:space-between;padding:10px 0;font-weight:700;font-size:1.05rem;border-top:2px solid #e6edf4;margin-top:8px}
        .total-row .val{color:#b30707}
        .surplus{color:#2a9d8f}
        .deficit{color:#b30707}

        .btns{display:flex;justify-content:space-between;gap:16px;margin-top:28px;flex-wrap:wrap;border-top:1px solid #eef3f8;padding-top:20px}
        .btn{padding:8px 28px;border-radius:40px;font-weight:600;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;font-size:.95rem}
        .btn-back{background:#eef2f8;color:#2c4a66}
        .btn-back:hover{background:#dce4ed}
        .btn-next{background:#b30707;color:#fff}
        .btn-next:hover{background:#8f0505}

        @media(max-width:700px){
            .row{flex-direction:column;align-items:stretch}
            .row label{width:auto}
            .row input,.row select{width:100%}
            .row .val{width:auto;text-align:left}
            .summary-grid{grid-template-columns:1fr}
            .btns{flex-direction:column;align-items:stretch}
            .btn{justify-content:center}
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1><i class="fas fa-calculator"></i> Funding Gap</h1>
    </div>

    <form method="POST" action="recommendations.php?id=<?=$clientId?>">
        <input type="hidden" name="client_id" value="<?=$clientId?>">

        <!-- Part 1 -->
        <div class="part-title"><span class="text">Part 1: Movable Funds</span></div>
        <div class="row"><label>1. Cash In The Bank</label><input type="number" id="cash" value="20000" step="100" oninput="calc()"><span class="val" id="cashDisp">$ 20,000</span></div>
        <div class="row"><label>2. Unit Trust or Investments</label><input type="number" id="invest" value="200000" step="100" oninput="calc()"><span class="val" id="investDisp">$ 200,000</span></div>
        <div class="row"><label>3. Retirement Fund</label><input type="number" id="retire" value="500000" step="100" oninput="calc()"><span class="val" id="retireDisp">$ 500,000</span></div>

        <!-- Part 2 -->
        <div class="part-title" style="margin-top:32px;"><span class="text">Part 2: Insurance Policies</span></div>
        <div class="row"><label>Do you have insurance policy?</label>
            <label style="width:auto;font-weight:400;flex:none;"><input type="radio" name="has_insurance" value="Yes" checked onchange="togglePolicies()"> Yes</label>
            <label style="width:auto;font-weight:400;flex:none;"><input type="radio" name="has_insurance" value="No" onchange="togglePolicies()"> No</label>
        </div>

        <div id="policiesWrap">
            <div id="policiesList"></div>
            <button type="button" class="btn-sm btn-add" onclick="addPolicy()"><i class="fas fa-plus"></i> Add Insurance Policy</button>
        </div>

        <!-- Summary -->
        <div style="margin:24px 0 16px;font-weight:700;font-size:1.1rem;color:#1a2c3e;">Summary of existing insurance coverage</div>
        <div id="summaryList"></div>

        <div style="margin-top:20px;border-top:2px solid #e6edf4;padding-top:16px;">
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

<script>
let policyCount = 0;
const planTypes = ['Investment Link','Whole Life','Universal Life','Term Life','Personal Accident','Medical & Hospitalization','Endowment'];

function addPolicy(data){
    policyCount++;
    const id = policyCount;
    const d = data || { company:'', policy:'', premium:'', plan:'', life:'', ci:'', term:'', pa:'' };
    const div = document.createElement('div');
    div.className = 'policy-box';
    div.id = 'policy_'+id;
    div.innerHTML = `
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
            <strong style="color:#1a2c3e;">[${String.fromCharCode(64+policyCount)}] Insurance Company</strong>
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

function removePolicy(id){
    document.getElementById('policy_'+id).remove();
    calc();
}

function togglePolicies(){
    const show = document.querySelector('input[name="has_insurance"]:checked').value === 'Yes';
    document.getElementById('policiesWrap').style.display = show ? 'block' : 'none';
    if(!show) document.getElementById('policiesList').innerHTML = '';
    calc();
}

function calc(){
    // Part 1
    let cash = parseFloat(document.getElementById('cash').value)||0;
    let invest = parseFloat(document.getElementById('invest').value)||0;
    let retire = parseFloat(document.getElementById('retire').value)||0;
    document.getElementById('cashDisp').textContent = '$ '+cash.toLocaleString();
    document.getElementById('investDisp').textContent = '$ '+invest.toLocaleString();
    document.getElementById('retireDisp').textContent = '$ '+retire.toLocaleString();
    document.getElementById('sCash').textContent = '$ '+cash.toLocaleString();
    document.getElementById('sInvest').textContent = '$ '+invest.toLocaleString();
    document.getElementById('sRetire').textContent = '$ '+retire.toLocaleString();

    // Part 2 - Insurance
    let totalIns = 0;
    let summaryHTML = '';
    const boxes = document.querySelectorAll('.policy-box');
    let idx = 0;
    boxes.forEach(box => {
        const company = box.querySelector('.pCompany').value || 'Unnamed';
        const life = parseFloat(box.querySelector('.pLife').value)||0;
        totalIns += life;
        idx++;
        const letter = String.fromCharCode(64+idx);
        summaryHTML += `<div class="summary-item"><span class="lbl">[${letter}] ${company}</span><span class="val">$ ${life.toLocaleString()}</span></div>`;
    });
    document.getElementById('summaryList').innerHTML = summaryHTML || '<div style="color:#6f8ea3;font-size:.9rem;">No insurance policies added.</div>';
    document.getElementById('sInsurance').textContent = '$ '+totalIns.toLocaleString();

    // Totals
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
// Init with sample data
document.addEventListener('DOMContentLoaded', function(){
    addPolicy({company:'Prudential', plan:'Whole Life', life:500000});
    addPolicy({company:'Manulife', plan:'Term Life', term:1000000, ci:200000});
    addPolicy({});
    calc();
});
</script>
</body>
</html>