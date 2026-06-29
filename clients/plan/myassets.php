<?php
$activePage = 'clients';
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = $clientId ? 'Client #' . $clientId : 'Unspecified Client';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assets · SmartWills</title>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* 固定侧边栏和顶栏，内容滚动 */
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            overflow-y: auto;
            z-index: 1000;
            background: #fff;
            border-right: 1px solid #eef2f8;
        }
        .main-content {
            margin-left: 250px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            flex: 1;
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 999;
            background: #fff;
            border-bottom: 1px solid #eef2f8;
        }
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 20px 0;
        }

        .assets-wrapper {
            width: 100%;
            max-width: none;
            margin: 0;
            background: #fff;
            border-radius: 32px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            padding: 24px 30px 30px;
            transition: 0.2s;
        }
        @media (max-width: 600px) {
            .assets-wrapper {
                padding: 20px 18px;
            }
        }

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
            font-size: 1.5rem;
            color: #1a2c3e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header h1 i {
            color: #b30707;
        }

        /* 客户信息样式 - 无背景框，仅头像+文字 */
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
        @media (max-width: 600px) {
            .header .client-info .avatar {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }
            .header .client-info .client-name-text {
                font-size: 0.9rem;
            }
        }

        /* ---------- 折叠卡片样式 ---------- */
        .accordion-section {
            margin-bottom: 16px;
            border-radius: 16px;
            border: 1px solid #eef2f8;
            overflow: hidden;
            background: #fff;
            transition: box-shadow 0.2s;
        }
        .accordion-section:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        }
        .accordion-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            cursor: pointer;
            background: #fafcfd;
            transition: background 0.2s;
            user-select: none;
        }
        .accordion-header:hover {
            background: #f0f4fa;
        }
        .accordion-header .title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a2c3e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .accordion-header .title i {
            color: #b30707;
            width: 20px;
            text-align: center;
        }
        .accordion-header .arrow {
            font-size: 1.1rem;
            color: #6f8ea3;
            transition: transform 0.25s ease;
        }
        .accordion-header .arrow.open {
            transform: rotate(180deg);
        }
        .accordion-body {
            padding: 0 22px 22px 22px;
            display: none;
            border-top: 1px solid #eef2f8;
            background: #fff;
        }
        .accordion-body.open {
            display: block;
            animation: fadeSlide 0.25s ease;
        }
        @keyframes fadeSlide {
            0% { opacity: 0; transform: translateY(-6px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* 表单样式 */
        .frow {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            flex-wrap: wrap;
            align-items: center;
        }
        .frow label {
            font-weight: 500;
            color: #0f3b5c;
            width: 150px;
            flex-shrink: 0;
            font-size: .9rem;
        }
        .frow input[type="text"],
        .frow input[type="number"] {
            flex: 1;
            min-width: 160px;
            padding: 6px 12px;
            border: 1px solid #d0dce8;
            border-radius: 30px;
            font-size: .9rem;
            outline: none;
            background: #fff;
        }
        .frow input:focus {
            border-color: #b30707;
            box-shadow: 0 0 0 3px rgba(179,7,7,0.1);
        }
        .frow .input-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
        }
        .frow .input-group label {
            width: auto;
            font-weight: 400;
            font-size: .85rem;
            display: flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
        }
        .frow .input-group input[type="radio"],
        .frow .input-group input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #b30707;
            margin: 0;
        }
        .frow .input-group input[type="number"] {
            width: 80px;
            min-width: 60px;
        }
        .frow .small {
            flex: 0.3;
            min-width: 80px;
        }
        .frow .half {
            flex: 0.5;
            min-width: 120px;
        }

        .sub-section {
            margin-top: 12px;
            padding-left: 20px;
            border-left: 3px solid #d0e3f5;
            margin-bottom: 12px;
        }
        .sub-section .sub-label {
            font-weight: 600;
            color: #1e466e;
            font-size: .95rem;
            margin-bottom: 8px;
        }

        .btn-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-top: 32px;
            flex-wrap: wrap;
            border-top: 1px solid #eef3f8;
            padding-top: 24px;
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
        .btn-back {
            background: #eef2f8;
            color: #2c4a66;
        }
        .btn-back:hover {
            background: #dce4ed;
        }
        .btn-save {
            background: #b30707;
            color: #fff;
        }
        .btn-save:hover {
            background: #8f0505;
        }

        @media (max-width: 700px) {
            .frow {
                flex-direction: column;
                align-items: stretch;
            }
            .frow label {
                width: auto;
            }
            .frow input[type="text"],
            .frow input[type="number"] {
                width: 100%;
            }
            .frow .input-group {
                flex-direction: column;
                align-items: flex-start;
            }
            .sub-section {
                padding-left: 10px;
            }
            .btn-row {
                flex-direction: column;
                align-items: stretch;
            }
            .btn {
                justify-content: center;
            }
            .accordion-header {
                padding: 14px 16px;
            }
            .accordion-body {
                padding: 0 16px 16px 16px;
            }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../../layouts/topbar.php'; ?>
        <div class="content">
            <div class="assets-wrapper">
                <div class="header">
                    <h1><i class="fas fa-address-card"></i> My Assets</h1>
                    <div class="client-info">
                        <span class="avatar">
                            <?php 
                                $initial = $clientId ? strtoupper(substr(trim($clientName), 0, 1)) : '?';
                                echo $initial;
                            ?>
                        </span>
                        <span class="client-name-text"><?php echo htmlspecialchars($clientName); ?></span>
                    </div>
                </div>

                <form method="POST" action="myassets.php?id=<?=$clientId?>">
                    <input type="hidden" name="client_id" value="<?=$clientId?>">

                    <!-- ===== 1. Family Information ===== -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-users"></i> Family Information</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <div class="frow">
                                <label>Spouse (with Will?)</label>
                                <div class="input-group">
                                    <label><input type="radio" name="spouse_will" value="yes"> Yes</label>
                                    <label><input type="radio" name="spouse_will" value="no" checked> No</label>
                                    <label><input type="radio" name="spouse_will" value="n_a"> N/A</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Children &lt; 21</label>
                                <input type="number" name="children_under_21" value="0" min="0" class="small">
                            </div>
                            <div class="frow">
                                <label>Children &gt; 21</label>
                                <input type="number" name="children_over_21" value="0" min="0" class="small">
                            </div>
                            <div class="frow">
                                <label>Grandparents alive?</label>
                                <div class="input-group">
                                    <label><input type="radio" name="grandparents" value="yes"> Yes</label>
                                    <label><input type="radio" name="grandparents" value="no" checked> No</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Parents alive?</label>
                                <div class="input-group">
                                    <label><input type="radio" name="parents" value="yes"> Yes</label>
                                    <label><input type="radio" name="parents" value="no" checked> No</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Brothers &amp; Sisters</label>
                                <input type="text" name="siblings" placeholder="e.g. 2 brothers, 1 sister" class="half">
                            </div>
                        </div>
                    </div>

                    <!-- ===== 2. Assets Information ===== -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-building"></i> Assets Information</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <div class="sub-section">
                                <div class="sub-label">Movable Assets:</div>
                                <div class="frow"><label>Bank / Savings</label><input type="text" name="bank_savings" placeholder="e.g. CIMB, Maybank"></div>
                                <div class="frow"><label>Unit Trust</label><input type="text" name="unit_trust" placeholder="e.g. Public Mutual"></div>
                                <div class="frow"><label>Share / Equity</label><input type="text" name="share_equity" placeholder="e.g. KLSE stocks"></div>
                                <div class="frow"><label>Investment</label><input type="text" name="investment" placeholder="e.g. Gold, bonds"></div>
                                <div class="frow"><label>Motor Vehicle</label><input type="text" name="motor_vehicle" placeholder="e.g. Toyota, BMW"></div>
                                <div class="frow"><label>Company / Business</label><input type="text" name="company_business" placeholder="e.g. Sdn Bhd"></div>
                            </div>
                            <div class="sub-section">
                                <div class="sub-label">Immovable Assets:</div>
                                <div class="frow"><label>HDB / Apartment</label><input type="text" name="hdb_apartment" placeholder="e.g. HDB block 123"></div>
                                <div class="frow"><label>Private Properties</label><input type="text" name="private_properties" placeholder="e.g. Landed house"></div>
                                <div class="frow"><label>Land</label><input type="text" name="land" placeholder="e.g. Agricultural land"></div>
                                <div class="frow"><label>Others</label><input type="text" name="assets_others" placeholder="Other assets"></div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== 3. Checklist ===== -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="title"><i class="fas fa-check-list"></i> Checklist</span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="accordion-body">
                            <div class="frow">
                                <label>Nationality</label>
                                <input type="text" name="nationality" placeholder="e.g. Malaysian" class="half">
                            </div>
                            <div class="frow">
                                <label>Cover assets in:</label>
                                <div class="input-group">
                                    <label><input type="checkbox" name="cover_assets[]" value="Malaysia"> Malaysia</label>
                                    <label><input type="checkbox" name="cover_assets[]" value="Singapore"> Singapore</label>
                                    <label><input type="checkbox" name="cover_assets[]" value="Brunei"> Brunei</label>
                                    <label><input type="checkbox" name="cover_assets[]" value="Others"> Others</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Understand English?</label>
                                <div class="input-group">
                                    <label><input type="radio" name="english" value="yes"> Yes</label>
                                    <label><input type="radio" name="english" value="no" checked> No</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Special Circumstances:</label>
                                <div class="input-group">
                                    <label><input type="checkbox" name="special[]" value="blind"> Blind</label>
                                    <label><input type="checkbox" name="special[]" value="illiterate"> Illiterate</label>
                                    <label><input type="checkbox" name="special[]" value="others"> Others</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Marital Status:</label>
                                <div class="input-group">
                                    <label><input type="radio" name="marital" value="single"> Single</label>
                                    <label><input type="radio" name="marital" value="married" checked> Married</label>
                                    <label><input type="radio" name="marital" value="divorced"> Divorced</label>
                                    <label><input type="radio" name="marital" value="widowed"> Widowed</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Debt or Loans?</label>
                                <div class="input-group">
                                    <label><input type="checkbox" name="debts[]" value="car"> Car Loan</label>
                                    <label><input type="checkbox" name="debts[]" value="home"> Home Loan</label>
                                    <label><input type="checkbox" name="debts[]" value="personal"> Personal Loan</label>
                                    <label><input type="checkbox" name="debts[]" value="others"> Others</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>In Progress of:</label>
                                <div class="input-group">
                                    <label><input type="checkbox" name="in_progress[]" value="pregnant"> Pregnant</label>
                                    <label><input type="checkbox" name="in_progress[]" value="new_marriage"> New Marriage</label>
                                    <label><input type="checkbox" name="in_progress[]" value="others"> Others</label>
                                </div>
                            </div>
                            <div class="frow">
                                <label>Health Issues?</label>
                                <div class="input-group">
                                    <label><input type="radio" name="health" value="yes"> Yes</label>
                                    <label><input type="radio" name="health" value="no" checked> No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="btn-row">
                        <a href="../clients.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Clients</a>
                        <a href="epchecklist.php?id=<?=$clientId?>" class="btn btn-save"><i class="fas fa-arrow-right"></i> Go to EP Checklist</a>
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
</script>
</body>
</html>