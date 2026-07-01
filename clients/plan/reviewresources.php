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
    <title>Estate Fund Need Analysis · SmartWills</title>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ----- 基础布局 ----- */
        html, body { height: 100%; margin: 0; }
        .wrapper { display: flex; height: 100vh; overflow: hidden; }
        .sidebar { position: fixed; top: 0; left: 0; height: 100vh; width: 250px; overflow-y: auto; z-index: 1000; background: #fff; border-right: 1px solid #eef2f8; }
        .main-content { margin-left: 250px; display: flex; flex-direction: column; height: 100vh; overflow: hidden; flex: 1; }
        .topbar { position: sticky; top: 0; z-index: 999; background: #fff; border-bottom: 1px solid #eef2f8; }
        .content { flex: 1; overflow-y: auto; padding: 20px 20px 0; }

        .review-wrapper {
            width: 100%;
            background: #fff;
            border-radius: 32px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            padding: 24px 30px 30px;
            transition: 0.2s;
        }

        /* ----- 进度条 ----- */
        .progress-steps {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
            margin-bottom: 28px;
            padding: 0 6px;
        }
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 22px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e8ef;
            z-index: 0;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .step .circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #e0e8ef;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            transition: background 0.2s;
            flex-shrink: 0;
        }
        .step.active .circle { background: #b30707; box-shadow: 0 4px 10px rgba(179,7,7,0.25); }
        .step .label {
            margin-top: 8px;
            font-size: 0.75rem;
            color: #7a93ab;
            font-weight: 500;
            line-height: 1.2;
            max-width: 90px;
            word-break: break-word;
        }
        .step.active .label { color: #b30707; font-weight: 700; }

        /* ----- 头部 ----- */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 24px;
            border-bottom: 2px solid #eef3f8;
            padding-bottom: 14px;
        }
        .header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a2c3e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header h1 i { color: #b30707; }
        .header .client-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header .client-info .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #e6f0fa;
            color: #2d7fb9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            flex-shrink: 0;
        }
        .header .client-info .client-name-text {
            font-weight: 600;
            color: #1e466e;
            font-size: 1.05rem;
        }

        /* ----- 手风琴 ----- */
        .accordion-section {
            margin-bottom: 16px;
            border-radius: 16px;
            border: 1px solid #eef2f8;
            overflow: hidden;
            background: #fff;
        }
        .accordion-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            cursor: pointer;
            background: #fafcfd;
            user-select: none;
        }
        .accordion-header:hover { background: #f0f4fa; }
        .accordion-header .title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a2c3e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .accordion-header .title i { color: #b30707; width: 20px; text-align: center; }
        .accordion-header .arrow {
            font-size: 1.1rem;
            color: #6f8ea3;
            transition: transform 0.25s ease;
        }
        .accordion-header .arrow.open { transform: rotate(180deg); }
        .accordion-body {
            padding: 0 22px 22px 22px;
            display: none;
            border-top: 1px solid #eef2f8;
            background: #fff;
        }
        .accordion-body.open { display: block; animation: fadeSlide 0.25s ease; }
        @keyframes fadeSlide { 0% { opacity: 0; transform: translateY(-6px); } 100% { opacity: 1; transform: translateY(0); } }

        /* ----- 表单行（共享样式） ----- */
        .a-row, .b-row, .c-row {
            display: grid;
            gap: 6px 10px;
            align-items: center;
            margin-bottom: 10px;
        }
        .a-row { grid-template-columns: 150px 1fr 120px; }
        .b-row { grid-template-columns: 150px 1fr 70px 70px 50px 1fr; }
        .c-row { grid-template-columns: 150px 1fr 120px; }

        .a-row label, .b-row label, .c-row label {
            font-weight: 500;
            color: #0f3b5c;
            font-size: .9rem;
        }
        .a-row input, .b-row input, .c-row input {
            padding: 6px 10px;
            border: 1px solid #d0dce8;
            border-radius: 30px;
            font-size: .9rem;
            outline: none;
            width: 100%;
        }
        .a-row input:focus, .b-row input:focus, .c-row input:focus {
            border-color: #b30707;
            box-shadow: 0 0 0 3px rgba(179,7,7,0.1);
        }
        .a-row .unit, .b-row .unit {
            font-size: .8rem;
            color: #6f8ea3;
            white-space: nowrap;
        }
        .a-row .total, .b-row .total, .c-row .total {
            font-weight: 600;
            color: #1e466e;
            background: #eef3f8;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: .9rem;
            text-align: center;
            justify-self: end;
            min-width: 80px;
        }
        .b-row .span2 { grid-column: span 2; }

        /* ----- 其他组件 ----- */
        .section-intro {
            font-size: .95rem;
            color: #2c4a66;
            margin-bottom: 24px;
            background: #f8fafd;
            padding: 14px 20px;
            border-radius: 16px;
        }
        .desc-text {
            font-size: .85rem;
            color: #4a6f8a;
            background: #f8fafd;
            padding: 10px 16px;
            border-radius: 12px;
            margin: 10px 0 14px;
            line-height: 1.6;
        }
        .badge {
            background: #b30707;
            color: #fff;
            font-size: .75rem;
            padding: 0 12px;
            border-radius: 30px;
        }
        .sub-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 2px solid #e6edf4;
            font-weight: 700;
            font-size: 1.05rem;
            flex-wrap: wrap;
        }
        .sub-total .formula { font-weight: 400; color: #4a6f8a; font-size: .95rem; }
        .sub-total .amt {
            background: #eef3f8;
            padding: 4px 24px;
            border-radius: 30px;
            min-width: 120px;
            text-align: center;
        }
        .grand-total {
            background: #f0f6fe;
            border-radius: 20px;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 16px;
        }
        .grand-total .label { font-size: 1.2rem; font-weight: 700; color: #1a2c3e; }
        .grand-total .amt {
            font-size: 1.8rem;
            font-weight: 800;
            color: #b30707;
            background: #fff;
            padding: 4px 30px;
            border-radius: 40px;
        }

        /* ----- 按钮 ----- */
        .btn-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-top: 24px;
            flex-wrap: wrap;
            border-top: 1px solid #eef3f8;
            padding-top: 20px;
        }
        .btn {
            padding: 10px 30px;
            border-radius: 40px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            transition: background 0.15s;
        }
        .btn-back { background: #eef2f8; color: #2c4a66; }
        .btn-back:hover { background: #dce4ed; }
        .btn-next { background: #b30707; color: #fff; }
        .btn-next:hover { background: #8f0505; }

        /* ===== 响应式 ===== */
        @media (max-width: 1024px) {
            .review-wrapper { padding: 20px 24px 24px; }
            .step .circle { width: 38px; height: 38px; font-size: 0.85rem; }
            .step .label { font-size: 0.65rem; max-width: 72px; }
            .progress-steps::before { top: 19px; }
            .header h1 { font-size: 1.3rem; }
            .b-row { grid-template-columns: 150px 1fr 60px 70px 40px 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .review-wrapper { padding: 16px 18px 20px; border-radius: 24px; }
            .progress-steps { margin-bottom: 20px; padding: 0; flex-wrap: nowrap; overflow-x: auto; gap: 4px; }
            .progress-steps::before { top: 16px; left: 10px; right: 10px; }
            .step { flex: 0 0 auto; min-width: 50px; }
            .step .circle { width: 32px; height: 32px; font-size: 0.7rem; }
            .step .label { font-size: 0.55rem; max-width: 52px; margin-top: 4px; }
            .header { flex-direction: column; align-items: flex-start; gap: 10px; padding-bottom: 12px; margin-bottom: 18px; }
            .header h1 { font-size: 1.2rem; }
            .header .client-info .avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .header .client-info .client-name-text { font-size: 0.95rem; }
            .accordion-header { padding: 14px 16px; }
            .accordion-header .title { font-size: 0.95rem; }
            .accordion-body { padding: 0 16px 16px 16px; }
            .a-row, .b-row, .c-row { grid-template-columns: 1fr; gap: 4px; }
            .a-row .total, .b-row .total, .c-row .total { justify-self: start; width: 100%; }
            .b-row .span2 { grid-column: 1; }
            .sub-total { justify-content: space-between; }
            .grand-total { flex-direction: column; gap: 10px; text-align: center; }
            .grand-total .amt { font-size: 1.4rem; padding: 4px 20px; }
            .btn-row { flex-direction: column; align-items: stretch; }
            .btn { justify-content: center; padding: 10px 20px; font-size: 0.9rem; }
            .section-intro { font-size: .85rem; padding: 12px 16px; }
            .desc-text { font-size: .8rem; padding: 8px 14px; }
        }

        @media (max-width: 480px) {
            .sidebar { width: 170px; }
            .main-content { margin-left: 170px; }
            .content { padding: 12px 10px 0; }
            .review-wrapper { padding: 12px 14px 16px; border-radius: 20px; }
            .progress-steps { margin-bottom: 16px; }
            .step .circle { width: 26px; height: 26px; font-size: 0.6rem; }
            .step .label { font-size: 0.45rem; max-width: 40px; }
            .progress-steps::before { top: 13px; }
            .header h1 { font-size: 1rem; gap: 6px; }
            .header .client-info .avatar { width: 30px; height: 30px; font-size: 0.75rem; }
            .header .client-info .client-name-text { font-size: 0.85rem; }
            .accordion-header { padding: 12px 14px; }
            .accordion-header .title { font-size: 0.85rem; gap: 6px; }
            .accordion-header .title i { width: 16px; font-size: 0.85rem; }
            .accordion-header .arrow { font-size: 0.9rem; }
            .accordion-body { padding: 0 14px 14px 14px; }
            .a-row label, .b-row label, .c-row label { font-size: 0.8rem; }
            .a-row input, .b-row input, .c-row input { padding: 5px 10px; font-size: 0.8rem; }
            .a-row .total, .b-row .total, .c-row .total { font-size: 0.8rem; min-width: 60px; padding: 3px 10px; }
            .grand-total .label { font-size: 1rem; }
            .grand-total .amt { font-size: 1.2rem; padding: 4px 16px; }
            .btn { padding: 8px 16px; font-size: 0.8rem; gap: 6px; }
            .btn-row { gap: 10px; margin-top: 20px; padding-top: 16px; }
            .section-intro { font-size: .8rem; padding: 10px 14px; }
        }

        @media (max-width: 400px) {
            .sidebar { width: 140px; }
            .main-content { margin-left: 140px; }
            .content { padding: 8px 6px 0; }
            .review-wrapper { padding: 10px 10px 14px; border-radius: 16px; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../../layouts/topbar.php'; ?>
        <div class="content">
            <div class="review-wrapper">
                <!-- 进度条 -->
                <div class="progress-steps">
                    <div class="step"><span class="circle">1</span><span class="label">My Assets</span></div>
                    <div class="step"><span class="circle">2</span><span class="label">Estate Planning Checklist</span></div>
                    <div class="step active"><span class="circle">3</span><span class="label">Estate Fund Need Analysis</span></div>
                    <div class="step"><span class="circle">4</span><span class="label">Funding Gap</span></div>
                    <div class="step"><span class="circle">5</span><span class="label">Product Recommendations</span></div>
                    <div class="step"><span class="circle">6</span><span class="label">Payment</span></div>
                </div>

                <div class="header">
                    <h1><i class="fas fa-calculator"></i> Estate Fund Need Analysis</h1>
                    <div class="client-info">
                        <span class="avatar"><?php echo strtoupper(substr(trim($clientName), 0, 1)); ?></span>
                        <span class="client-name-text"><?php echo htmlspecialchars($clientName); ?></span>
                    </div>
                </div>

                <div class="section-intro">
                    <i class="fas fa-info-circle" style="color:#b30707;margin-right:8px;"></i>
                    This section allows you to determine the amount of funding needed for your estate plan when you pass on.
                </div>

                <form method="POST" action="fundinggap.php">
                    <input type="hidden" name="client_id" value="<?=$clientId?>">

                    <!-- A. Estate Administration Fee -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-file-invoice-dollar"></i> A. Estate Administration Fee <span class="badge">5%</span></span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <div class="a-row">
                                <label>Total value of movable &amp; immovable assets</label>
                                <input type="number" id="assetValue" value="5000000" step="1000" oninput="calc()">
                                <span class="total" id="adminFeeDisplay">$ 250,000</span>
                            </div>
                            <div class="desc-text">
                                <i class="fas fa-info-circle" style="color:#b30707;margin-right:6px;"></i>
                                Estate Administration Fee refers to the cost associated with managing and settling an individual's estate after their passing. This includes legal fees, executor fees, court costs, and expenses related to the distribution of assets, payment of debts, and resolution of estate-related matters.
                            </div>
                            <div class="sub-total">
                                <span class="formula" id="adminFeeFormula">Estate Administration Fee (A): 5,000,000 × 5% = 250,000</span>
                                <span class="amt" id="adminFeeSubTotal">$ 250,000</span>
                                <input type="hidden" name="admin_fee" id="adminFeeHidden" value="250000">
                            </div>
                        </div>
                    </div>

                    <!-- B. Family Living Expenses -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-home"></i> B. Family Living Expenses</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <?php
                            $bItems = [
                                ['label'=>'1. Living expenses', 'id'=>'living', 'val1'=>25000, 'val2'=>10, 'unit1'=>'Monthly ×', 'unit2'=>'years'],
                                ['label'=>'2. Allowance for parent', 'id'=>'parent', 'val1'=>25000, 'val2'=>10, 'unit1'=>'Monthly ×', 'unit2'=>'years'],
                                ['label'=>'3. Allowance for guardian', 'id'=>'guardian', 'val1'=>25000, 'val2'=>10, 'unit1'=>'Monthly ×', 'unit2'=>'years'],
                                ['label'=>'4. Education Fund', 'id'=>'edu', 'val1'=>300000, 'val2'=>3, 'unit1'=>'per child ×', 'unit2'=>'children'],
                                ['label'=>'5. Medical & healthcare fund', 'id'=>'medical', 'val1'=>100000, 'val2'=>2, 'unit1'=>'per pax ×', 'unit2'=>'pax'],
                                ['label'=>'6. Emergency Fund', 'id'=>'emergency', 'val1'=>200000, 'val2'=>0, 'unit1'=>'Lumpsum', 'unit2'=>'']
                            ];
                            foreach($bItems as $b):
                                $isEmergency = $b['id'] === 'emergency';
                            ?>
                            <div class="b-row">
                                <label><?=$b['label']?></label>
                                <input type="number" id="<?=$b['id']?>_val1" value="<?=$b['val1']?>" step="<?=$isEmergency?1000:100?>" oninput="calc()">
                                <span class="unit"><?=$b['unit1']?></span>
                                <?php if(!$isEmergency): ?>
                                <input type="number" id="<?=$b['id']?>_val2" value="<?=$b['val2']?>" step="1" oninput="calc()">
                                <span class="unit"><?=$b['unit2']?></span>
                                <?php else: ?>
                                <span class="unit"></span><span></span>
                                <?php endif; ?>
                                <span class="total" id="<?=$b['id']?>_total">$ <?=number_format($b['val1'] * ($b['val2'] ?: 1))?></span>
                            </div>
                            <?php endforeach; ?>
                            <div class="sub-total">
                                <span>Sub-total (B):</span>
                                <span class="amt" id="familyTotalDisplay">$ 2,500,000</span>
                                <input type="hidden" name="family_total" id="familyTotalHidden" value="2500000">
                            </div>
                        </div>
                    </div>

                    <!-- C. Personal Debts -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-credit-card"></i> C. Personal Debts</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <?php
                            $cItems = [
                                ['label'=>'1. Personal Loan / Credit Cards', 'id'=>'debt_loan', 'val'=>20000],
                                ['label'=>'2. Car Loan', 'id'=>'debt_car', 'val'=>200000],
                                ['label'=>'3. Housing Loan', 'id'=>'debt_housing', 'val'=>500000],
                                ['label'=>'4. Personal Guarantor / Others', 'id'=>'debt_others', 'val'=>10000]
                            ];
                            foreach($cItems as $c):
                            ?>
                            <div class="c-row">
                                <label><?=$c['label']?></label>
                                <input type="number" id="<?=$c['id']?>" value="<?=$c['val']?>" step="100" oninput="calc()">
                                <span class="total" id="<?=$c['id']?>_display">$ <?=number_format($c['val'])?></span>
                            </div>
                            <?php endforeach; ?>
                            <div class="sub-total">
                                <span>Sub-total (C):</span>
                                <span class="amt" id="debtTotalDisplay">$ 730,000</span>
                                <input type="hidden" name="debt_total" id="debtTotalHidden" value="730000">
                            </div>
                        </div>
                    </div>

                    <!-- Grand Total -->
                    <div class="grand-total">
                        <span class="label">The Total Amount of Estate Funds Needed (A+B+C)</span>
                        <span class="amt" id="grandTotalDisplay">$ 3,480,000</span>
                        <input type="hidden" name="grand_total" id="grandTotalHidden" value="3480000">
                    </div>

                    <div class="btn-row">
                        <a href="epchecklist.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Checklist</a>
                        <button type="submit" class="btn btn-next">Go to Funding Gap <i class="fas fa-arrow-right"></i></button>
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
    if (isOpen) {
        body.classList.remove('open');
        arrow.classList.remove('open');
    } else {
        body.classList.add('open');
        arrow.classList.add('open');
    }
}

function calc(){
    let asset = parseFloat(document.getElementById('assetValue').value) || 0;
    let admin = asset * 0.05;
    document.getElementById('adminFeeDisplay').textContent = '$ ' + admin.toLocaleString();
    document.getElementById('adminFeeSubTotal').textContent = '$ ' + admin.toLocaleString();
    document.getElementById('adminFeeHidden').value = admin;
    document.getElementById('adminFeeFormula').textContent = 
        'Estate Administration Fee (A): ' + asset.toLocaleString() + ' × 5% = ' + admin.toLocaleString();

    const bIds = ['living','parent','guardian','edu','medical','emergency'];
    let familyTotal = 0;
    bIds.forEach(id => {
        let v1 = parseFloat(document.getElementById(id+'_val1').value) || 0;
        let v2 = parseFloat(document.getElementById(id+'_val2')?.value) || 0;
        let total = id === 'emergency' ? v1 : v1 * v2 * (id === 'edu' || id === 'medical' ? 1 : 12);
        document.getElementById(id+'_total').textContent = '$ ' + total.toLocaleString();
        familyTotal += total;
    });
    document.getElementById('familyTotalDisplay').textContent = '$ ' + familyTotal.toLocaleString();
    document.getElementById('familyTotalHidden').value = familyTotal;

    const cIds = ['debt_loan','debt_car','debt_housing','debt_others'];
    let debtTotal = 0;
    cIds.forEach(id => {
        let val = parseFloat(document.getElementById(id).value) || 0;
        document.getElementById(id+'_display').textContent = '$ ' + val.toLocaleString();
        debtTotal += val;
    });
    document.getElementById('debtTotalDisplay').textContent = '$ ' + debtTotal.toLocaleString();
    document.getElementById('debtTotalHidden').value = debtTotal;

    let grand = admin + familyTotal + debtTotal;
    document.getElementById('grandTotalDisplay').textContent = '$ ' + grand.toLocaleString();
    document.getElementById('grandTotalHidden').value = grand;
}
document.addEventListener('DOMContentLoaded', calc);
</script>
</body>
</html>