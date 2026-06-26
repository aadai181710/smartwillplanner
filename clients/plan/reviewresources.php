<?php
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = $clientId ? 'Client #' . $clientId : 'Unspecified Client';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Resources · SmartWills</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{background:#f2f6fb;font-family:'Segoe UI',Roboto,sans-serif;padding:30px 20px;display:flex;justify-content:center}
        .page-wrapper{max-width:960px;width:100%;background:#fff;border-radius:32px;padding:35px 40px 30px;box-shadow:0 12px 40px rgba(0,0,0,0.08)}
        @media(max-width:600px){.page-wrapper{padding:20px 18px}}
        .header{display:flex;justify-content:space-between;flex-wrap:wrap;margin-bottom:28px;border-bottom:2px solid #eef3f8;padding-bottom:16px}
        .header h1{font-size:1.6rem;font-weight:700;color:#1a2c3e;display:flex;align-items:center;gap:10px}
        .header h1 i{color:#b30707}
        .header .client-badge{background:#eef3f8;padding:6px 18px;border-radius:40px;font-size:.9rem;font-weight:600;color:#1e466e}
        .section-intro{font-size:.95rem;color:#2c4a66;margin-bottom:28px;background:#f8fafd;padding:14px 20px;border-radius:16px}
        .section-block{margin-bottom:40px;border-bottom:1px dashed #e6edf4;padding-bottom:28px}
        .section-block:last-of-type{border-bottom:none}
        .section-title{font-size:1.2rem;font-weight:700;color:#1a2c3e;margin-bottom:18px;display:flex;align-items:center;gap:10px}
        .section-title .badge{background:#b30707;color:#fff;font-size:.75rem;padding:0 12px;border-radius:30px}

        /*Part B: 6-column grid */
        .b-row {
            display: grid;
            grid-template-columns: 150px 1fr 70px 70px 50px 1fr;
            gap: 6px 10px;
            align-items: center;
            margin-bottom: 10px;
        }
        .b-row label{font-weight:500;color:#0f3b5c;font-size:.9rem}
        .b-row input{padding:6px 10px;border:1px solid #d0dce8;border-radius:30px;font-size:.9rem;outline:none;width:100%}
        .b-row input:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .b-row .unit{font-size:.8rem;color:#6f8ea3;white-space:nowrap}
        .b-row .total{font-weight:600;color:#1e466e;background:#eef3f8;padding:4px 12px;border-radius:30px;font-size:.9rem;text-align:center;justify-self:end;min-width:80px}
        .b-row .span2{grid-column:span 2}

        /*Part C: 3-column grid */
        .c-row {
            display: grid;
            grid-template-columns: 150px 1fr 120px;
            gap: 6px 10px;
            align-items: center;
            margin-bottom: 10px;
        }
        .c-row label{font-weight:500;color:#0f3b5c;font-size:.9rem}
        .c-row input{padding:6px 10px;border:1px solid #d0dce8;border-radius:30px;font-size:.9rem;outline:none;width:100%}
        .c-row input:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .c-row .total{font-weight:600;color:#1e466e;background:#eef3f8;padding:4px 12px;border-radius:30px;font-size:.9rem;text-align:center;justify-self:end;min-width:80px}

        /*Part A: 3-column grid */
        .a-row {
            display: grid;
            grid-template-columns: 150px 1fr 120px;
            gap: 6px 10px;
            align-items: center;
            margin-bottom: 10px;
        }
        .a-row label{font-weight:500;color:#0f3b5c;font-size:.9rem}
        .a-row input{padding:6px 10px;border:1px solid #d0dce8;border-radius:30px;font-size:.9rem;outline:none;width:100%}
        .a-row input:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .a-row .total{font-weight:600;color:#1e466e;background:#eef3f8;padding:4px 12px;border-radius:30px;font-size:.9rem;text-align:center;justify-self:end;min-width:80px}

        .desc-text{font-size:.85rem;color:#4a6f8a;background:#f8fafd;padding:10px 16px;border-radius:12px;margin:10px 0 14px;line-height:1.6}
        .sub-total{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-top:14px;padding-top:12px;border-top:2px solid #e6edf4;font-weight:700;font-size:1.05rem;flex-wrap:wrap}
        .sub-total .formula{font-weight:400;color:#4a6f8a;font-size:.95rem}
        .sub-total .amt{background:#eef3f8;padding:4px 24px;border-radius:30px;min-width:120px;text-align:center}

        .grand-total{background:#f0f6fe;border-radius:20px;padding:18px 24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}
        .grand-total .label{font-size:1.2rem;font-weight:700;color:#1a2c3e}
        .grand-total .amt{font-size:1.8rem;font-weight:800;color:#b30707;background:#fff;padding:4px 30px;border-radius:40px}
        .btn-row{display:flex;justify-content:space-between;gap:16px;margin-top:32px;flex-wrap:wrap;border-top:1px solid #eef3f8;padding-top:24px}
        .btn{padding:10px 30px;border-radius:40px;font-weight:600;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:10px;font-size:1rem}
        .btn-back{background:#eef2f8;color:#2c4a66}
        .btn-back:hover{background:#dce4ed}
        .btn-next{background:#b30707;color:#fff}
        .btn-next:hover{background:#8f0505}

        @media(max-width:700px){
            .b-row{grid-template-columns:1fr;gap:4px}
            .b-row .total{justify-self:start;width:100%}
            .b-row .span2{grid-column:1}
            .c-row{grid-template-columns:1fr;gap:4px}
            .c-row .total{justify-self:start;width:100%}
            .a-row{grid-template-columns:1fr;gap:4px}
            .a-row .total{justify-self:start;width:100%}
            .sub-total{justify-content:space-between}
            .grand-total{flex-direction:column;gap:10px}
            .btn-row{flex-direction:column;align-items:stretch}
            .btn{justify-content:center}
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="header">
        <h1><i class="fas fa-calculator"></i> Review Resources</h1>
    </div>

    <div class="section-intro"><i class="fas fa-info-circle" style="color:#b30707;margin-right:8px;"></i> This section allows you to determine the amount of funding needed for your estate plan when you pass on.</div>

    <form method="POST" action="fundinggap.php">
        <input type="hidden" name="client_id" value="<?=$clientId?>">

        <!-- ===== A ===== -->
        <div class="section-block">
            <div class="section-title">A. Estate Administration Fee <span class="badge">5%</span></div>
            <div class="a-row">
                <label>Total value of movable &amp; immovable assets</label>
                <input type="number" id="assetValue" value="5000000" step="1000" oninput="calc()">
                <span class="total" id="adminFeeDisplay">$ 250,000</span>
            </div>
            <div class="desc-text"><i class="fas fa-info-circle" style="color:#b30707;margin-right:6px;"></i> Estate Administration Fee refers to the cost associated with managing and settling an individual's estate after their passing. This includes legal fees, executor fees, court costs, and expenses related to the distribution of assets, payment of debts, and resolution of estate-related matters.</div>
            <div class="sub-total">
                <span class="formula" id="adminFeeFormula">Estate Administration Fee (A): 5,000,000 × 5% = 250,000</span>
                <span class="amt" id="adminFeeSubTotal">$ 250,000</span>
                <input type="hidden" name="admin_fee" id="adminFeeHidden" value="250000">
            </div>
        </div>

        <!-- ===== B ===== -->
        <div class="section-block">
            <div class="section-title">B. Family Living Expenses</div>
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
                <span class="unit"></span>
                <span></span>
                <?php endif; ?>
                <span class="total" id="<?=$b['id']?>_total">$ <?=number_format($b['val1'] * ($b['val2'] ?: 1))?></span>
            </div>
            <?php endforeach; ?>
            <div class="sub-total"><span>Sub-total (B):</span><span class="amt" id="familyTotalDisplay">$ 2,500,000</span><input type="hidden" name="family_total" id="familyTotalHidden" value="2500000"></div>
        </div>

        <!-- ===== C ===== -->
        <div class="section-block">
            <div class="section-title">C. Personal Debts</div>
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
            <div class="sub-total"><span>Sub-total (C):</span><span class="amt" id="debtTotalDisplay">$ 730,000</span><input type="hidden" name="debt_total" id="debtTotalHidden" value="730000"></div>
        </div>

        <!-- ===== Grand Total ===== -->
        <div class="grand-total">
            <span class="label">The Total Amount of Estate Funds Needed (A+B+C)</span>
            <span class="amt" id="grandTotalDisplay">$ 3,480,000</span>
            <input type="hidden" name="grand_total" id="grandTotalHidden" value="3480000">
        </div>

        <!-- Buttons -->
        <div class="btn-row">
            <a href="epchecklist.php?id=<?=$clientId?>" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Checklist</a>
            <button type="submit" class="btn btn-next">Go to Funding Gap <i class="fas fa-arrow-right"></i></button>
        </div>
    </form>
</div>

<script>
function calc(){
    // A
    let asset = parseFloat(document.getElementById('assetValue').value) || 0;
    let admin = asset * 0.05;
    document.getElementById('adminFeeDisplay').textContent = '$ ' + admin.toLocaleString();
    document.getElementById('adminFeeSubTotal').textContent = '$ ' + admin.toLocaleString();
    document.getElementById('adminFeeHidden').value = admin;
    document.getElementById('adminFeeFormula').textContent = 
        'Estate Administration Fee (A): ' + asset.toLocaleString() + ' × 5% = ' + admin.toLocaleString();

    // B
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

    // C
    const cIds = ['debt_loan','debt_car','debt_housing','debt_others'];
    let debtTotal = 0;
    cIds.forEach(id => {
        let val = parseFloat(document.getElementById(id).value) || 0;
        document.getElementById(id+'_display').textContent = '$ ' + val.toLocaleString();
        debtTotal += val;
    });
    document.getElementById('debtTotalDisplay').textContent = '$ ' + debtTotal.toLocaleString();
    document.getElementById('debtTotalHidden').value = debtTotal;

    // Grand
    let grand = admin + familyTotal + debtTotal;
    document.getElementById('grandTotalDisplay').textContent = '$ ' + grand.toLocaleString();
    document.getElementById('grandTotalHidden').value = grand;
}
document.addEventListener('DOMContentLoaded', calc);
</script>
</body>
</html>