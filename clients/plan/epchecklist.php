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
    <title>Estate Planning Checklist · SmartWills</title>
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

        .checklist-wrapper {
            width: 100%;
            background: #fff;
            border-radius: 32px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            padding: 24px 30px 30px;
            transition: 0.2s;
        }

        /* 进度条 */
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

        /* 头部 */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 28px;
            border-bottom: 2px solid #eef3f8;
            padding-bottom: 16px;
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

        /* 问题区域 */
        .question-group {
            margin-bottom: 28px;
            border-bottom: 1px dashed #e6edf4;
            padding-bottom: 22px;
        }
        .question-group:last-of-type { border-bottom: none; }
        .question-text {
            font-weight: 600;
            color: #0f3b5c;
            font-size: 1rem;
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .question-text .qnum {
            display: inline-block;
            background: #e6f0fa;
            color: #1f6390;
            border-radius: 30px;
            padding: 0 14px;
            font-size: 0.8rem;
            margin-right: 8px;
            font-weight: 700;
        }
        .options-group {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            margin-top: 6px;
        }
        .options-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            color: #2c4a66;
            cursor: pointer;
            font-size: 0.95rem;
        }
        .options-group input[type="radio"],
        .options-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #b30707;
            cursor: pointer;
        }
        .sub-question {
            margin-top: 18px;
            margin-left: 20px;
            padding-left: 18px;
            border-left: 3px solid #d0e3f5;
        }
        .sub-question .question-text { font-weight: 500; color: #1e466e; }
        .sub-question .options-group { gap: 16px; }
        .text-input { margin-top: 10px; }
        .text-input input[type="text"],
        .text-input input[type="number"] {
            padding: 8px 16px;
            border: 1px solid #d0dce8;
            border-radius: 30px;
            font-size: 0.95rem;
            width: 100%;
            max-width: 400px;
            outline: none;
            transition: 0.2s;
        }
        .text-input input:focus {
            border-color: #b30707;
            box-shadow: 0 0 0 3px rgba(179,7,7,0.1);
        }
        .text-input .hint {
            color: #6f8ea3;
            font-size: 0.8rem;
            margin-left: 12px;
        }

        /* 按钮 */
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
        .btn-back { background: #eef2f8; color: #2c4a66; }
        .btn-back:hover { background: #dce4ed; }
        .btn-next { background: #b30707; color: #fff; }
        .btn-next:hover { background: #8f0505; }

        /* ----- 响应式 ----- */
        @media (max-width: 1024px) {
            .checklist-wrapper { padding: 20px 24px 24px; }
            .step .circle { width: 38px; height: 38px; font-size: 0.85rem; }
            .step .label { font-size: 0.65rem; max-width: 72px; }
            .progress-steps::before { top: 19px; }
            .header h1 { font-size: 1.3rem; }
        }

        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .checklist-wrapper { padding: 16px 18px 20px; border-radius: 24px; }
            .progress-steps { margin-bottom: 20px; padding: 0; flex-wrap: nowrap; overflow-x: auto; gap: 4px; }
            .progress-steps::before { top: 16px; left: 10px; right: 10px; }
            .step { flex: 0 0 auto; min-width: 50px; }
            .step .circle { width: 32px; height: 32px; font-size: 0.7rem; }
            .step .label { font-size: 0.55rem; max-width: 52px; margin-top: 4px; }
            .header { flex-direction: column; align-items: flex-start; gap: 10px; padding-bottom: 12px; margin-bottom: 18px; }
            .header h1 { font-size: 1.2rem; }
            .header .client-info .avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .header .client-info .client-name-text { font-size: 0.95rem; }
            .question-group { margin-bottom: 20px; padding-bottom: 16px; }
            .question-text { font-size: 0.95rem; }
            .options-group { gap: 16px; }
            .options-group label { font-size: 0.9rem; }
            .sub-question { margin-left: 12px; padding-left: 12px; }
            .text-input input { max-width: 100%; }
            .btn-row { flex-direction: column; align-items: stretch; gap: 12px; margin-top: 24px; padding-top: 20px; }
            .btn { justify-content: center; padding: 10px 20px; font-size: 0.9rem; }
        }

        @media (max-width: 480px) {
            .sidebar { width: 170px; }
            .main-content { margin-left: 170px; }
            .content { padding: 12px 10px 0; }
            .checklist-wrapper { padding: 12px 14px 16px; border-radius: 20px; }
            .progress-steps { margin-bottom: 16px; }
            .step .circle { width: 26px; height: 26px; font-size: 0.6rem; }
            .step .label { font-size: 0.45rem; max-width: 40px; }
            .progress-steps::before { top: 13px; }
            .header h1 { font-size: 1rem; gap: 6px; }
            .header .client-info .avatar { width: 30px; height: 30px; font-size: 0.75rem; }
            .header .client-info .client-name-text { font-size: 0.85rem; }
            .question-text { font-size: 0.9rem; }
            .options-group { gap: 12px; }
            .options-group label { font-size: 0.85rem; }
            .options-group input[type="radio"] { width: 16px; height: 16px; }
            .sub-question { margin-left: 8px; padding-left: 8px; }
            .text-input input { font-size: 0.85rem; padding: 6px 12px; }
            .btn { padding: 8px 16px; font-size: 0.8rem; gap: 6px; }
            .btn-row { gap: 10px; margin-top: 20px; padding-top: 16px; }
        }

        @media (max-width: 400px) {
            .sidebar { width: 140px; }
            .main-content { margin-left: 140px; }
            .content { padding: 8px 6px 0; }
            .checklist-wrapper { padding: 10px 10px 14px; border-radius: 16px; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../../layouts/topbar.php'; ?>
        <div class="content">
            <div class="checklist-wrapper">
                <!-- 进度条 -->
                <div class="progress-steps">
                    <div class="step"><span class="circle">1</span><span class="label">My Assets</span></div>
                    <div class="step active"><span class="circle">2</span><span class="label">Estate Planning Checklist</span></div>
                    <div class="step"><span class="circle">3</span><span class="label">Estate Fund Need Analysis</span></div>
                    <div class="step"><span class="circle">4</span><span class="label">Funding Gap</span></div>
                    <div class="step"><span class="circle">5</span><span class="label">Product Recommendations</span></div>
                    <div class="step"><span class="circle">6</span><span class="label">Payment</span></div>
                </div>

                <div class="header">
                    <h1><i class="fas fa-clipboard-list"></i> Estate Planning Checklist</h1>
                    <div class="client-info">
                        <span class="avatar"><?php echo strtoupper(substr(trim($clientName), 0, 1)); ?></span>
                        <span class="client-name-text"><?php echo htmlspecialchars($clientName); ?></span>
                    </div>
                </div>

                <form id="checklistForm" method="POST" action="reviewresources.php">
                    <input type="hidden" name="client_id" value="<?php echo $clientId; ?>">

                    <!-- 问题 1 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">1</span> Have you created an estate plan to ensure your assets are distributed according to your wishes and benefit your loved ones?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q1" value="Yes"> Yes</label>
                            <label><input type="radio" name="q1" value="No"> No</label>
                        </div>
                    </div>

                    <!-- 问题 2 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">2</span> Do you know that your assets might be frozen whether or not you have a Will?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q2" value="Yes, I am aware"> Yes, I am aware</label>
                            <label><input type="radio" name="q2" value="No, I am not aware"> No, I am not aware</label>
                        </div>
                    </div>

                    <!-- 问题 3 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">3</span> Have you written a Will as part of your estate planning?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q3" value="Yes" class="q3_radio"> Yes</label>
                            <label><input type="radio" name="q3" value="No" class="q3_radio"> No</label>
                        </div>
                        <div id="q3_yes_sub" style="display:none;">
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">3.1</span> Whom have you appointed as the executor in your Will?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q3_1_yes" value="Spouse"> Spouse</label>
                                    <label><input type="radio" name="q3_1_yes" value="Parents"> Parents</label>
                                    <label><input type="radio" name="q3_1_yes" value="Children"> Children</label>
                                    <label><input type="radio" name="q3_1_yes" value="Siblings"> Siblings</label>
                                    <label><input type="radio" name="q3_1_yes" value="Lawyer"> Lawyer</label>
                                    <label><input type="radio" name="q3_1_yes" value="Others"> Others</label>
                                </div>
                            </div>
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">3.2</span> Does the executor you have chosen have the ability to fulfil the below responsibilities?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q3_2_yes" value="Yes"> Yes</label>
                                    <label><input type="radio" name="q3_2_yes" value="No"> No</label>
                                </div>
                                <div style="margin-top:8px; font-size:0.85rem; color:#4a6f8a; background:#f8fafd; padding:10px 16px; border-radius:12px;">
                                    • Obtain Documents: Secure an extract of the Will and the Death Certificate.<br>
                                    • Submit Will and Information: Present the original Will along with a list of assets and liabilities.<br>
                                    • Apply for Probate: File for a Grant of Probate.<br>
                                    • Attend Court Hearing: Participate in the court hearing for the probate application.<br>
                                    • Manage Estate: Once probate is granted, collect all assets to settle debts and liabilities.<br>
                                    • Distribute Assets: Allocate the remaining assets according to the Will.
                                </div>
                            </div>
                        </div>
                        <div id="q3_no_sub" style="display:none;">
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">3.1</span> Are you aware that if you don’t have a Will, all legal beneficiaries (such as parents, spouses, and children) must reach a consensus to appoint a single representative, known as an administrator, to execute your estate?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q3_1_no" value="Yes, I am aware"> Yes, I am aware</label>
                                    <label><input type="radio" name="q3_1_no" value="No, I have no idea"> No, I have no idea</label>
                                </div>
                            </div>
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">3.2</span> Do you have any worries about whether the administrator is capable of effectively managing your estate and making necessary arrangements before distributing assets to your beneficiaries?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q3_2_no" value="Yes"> Yes</label>
                                    <label><input type="radio" name="q3_2_no" value="No"> No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 问题 4 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">4</span> Are you aware that your executor or administrator will need to settle all outstanding debts and taxes before they can distribute the estate to your beneficiaries?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q4" value="I am aware"> I am aware</label>
                            <label><input type="radio" name="q4" value="I am not aware"> I am not aware</label>
                        </div>
                    </div>

                    <!-- 问题 5 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">5</span> Have you allocated sufficient funds in the estate to cover the administration fees and other related expenses for the executor/administrator?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q5_funds" value="Yes" class="q5_radio"> Yes</label>
                            <label><input type="radio" name="q5_funds" value="No" class="q5_radio"> No</label>
                        </div>
                        <div class="sub-question" id="q5_1_group" style="display:none;">
                            <div class="question-text"><span class="qnum">5.1</span> <span id="q5_1_label">Could you please specify the amount of funds you have set aside to cover the administration fees and related expenses for the executor / administrator?</span></div>
                            <div class="text-input">
                                <input type="text" name="q5_1_amount" placeholder="e.g. $50,000">
                                <span class="hint">USD</span>
                            </div>
                        </div>
                    </div>

                    <!-- 问题 6 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">6</span> Do you have minor children?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q6" value="Yes" class="q6_radio"> Yes</label>
                            <label><input type="radio" name="q6" value="No" class="q6_radio"> No</label>
                        </div>
                        <div id="q6_sub" style="display:none;">
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">6.1</span> Are you aware that you need to appoint a guardian to take care of your minor children?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q6_1" value="Yes"> Yes</label>
                                    <label><input type="radio" name="q6_1" value="No"> No</label>
                                </div>
                            </div>
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">6.2</span> Whom would you choose to appoint as a guardian to care for your minor children in the event of an unexpected circumstance?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q6_2" value="Spouse"> Spouse</label>
                                    <label><input type="radio" name="q6_2" value="Parents"> Parents</label>
                                    <label><input type="radio" name="q6_2" value="Siblings"> Siblings</label>
                                    <label><input type="radio" name="q6_2" value="Others"> Others</label>
                                </div>
                            </div>
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">6.3</span> Is your potential guardian financially prepared and capable of providing for your children’s needs?</div>
                                <div class="options-group">
                                    <label><input type="radio" name="q6_3" value="Yes"> Yes</label>
                                    <label><input type="radio" name="q6_3" value="No"> No</label>
                                </div>
                            </div>
                            <div class="sub-question">
                                <div class="question-text"><span class="qnum">6.4</span> How much will you allocate to ensure your guardian can adequately cover the basic needs of your minor children?</div>
                                <div class="text-input">
                                    <input type="text" name="q6_4_amount" placeholder="e.g. $100,000">
                                    <span class="hint">USD</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 问题 7 -->
                    <div class="question-group">
                        <div class="question-text"><span class="qnum">7</span> Would you like to understand how much funding is necessary to protect a family and estate in the event of someone's passing?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q7" value="Yes"> Yes</label>
                            <label><input type="radio" name="q7" value="No"> No</label>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn btn-back" onclick="window.location.href='myassets.php?id=<?php echo $clientId; ?>';">
                            <i class="fas fa-arrow-left"></i> Back to My Assets
                        </button>
                        <button type="submit" class="btn btn-next"><i class="fas fa-arrow-right"></i> Go to Estate Fund Need Analysis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        // 问题3 子显示
        const q3Radios = document.querySelectorAll('.q3_radio');
        const q3YesSub = document.getElementById('q3_yes_sub');
        const q3NoSub = document.getElementById('q3_no_sub');
        q3Radios.forEach(r => r.addEventListener('change', function() {
            q3YesSub.style.display = this.value === 'Yes' ? 'block' : 'none';
            q3NoSub.style.display = this.value === 'No' ? 'block' : 'none';
        }));

        // 问题5 子显示
        const q5Radios = document.querySelectorAll('.q5_radio');
        const q5Group = document.getElementById('q5_1_group');
        const q5Label = document.getElementById('q5_1_label');
        q5Radios.forEach(r => r.addEventListener('change', function() {
            q5Group.style.display = 'block';
            q5Label.textContent = this.value === 'Yes'
                ? 'Could you please specify the amount of funds you have set aside to cover the administration fees and related expenses for the executor / administrator?'
                : 'Could you please specify the amount of funds you will reserve to cover the administration fees and related expenses for the executor / administrator?';
        }));

        // 问题6 子显示
        const q6Radios = document.querySelectorAll('.q6_radio');
        const q6Sub = document.getElementById('q6_sub');
        q6Radios.forEach(r => r.addEventListener('change', function() {
            q6Sub.style.display = this.value === 'Yes' ? 'block' : 'none';
        }));

        // 页面加载时恢复已选状态
        document.addEventListener('DOMContentLoaded', function() {
            const q3Checked = document.querySelector('input[name="q3"]:checked');
            if (q3Checked) {
                q3YesSub.style.display = q3Checked.value === 'Yes' ? 'block' : 'none';
                q3NoSub.style.display = q3Checked.value === 'No' ? 'block' : 'none';
            }
            const q5Checked = document.querySelector('input[name="q5_funds"]:checked');
            if (q5Checked) {
                q5Group.style.display = 'block';
                q5Label.textContent = q5Checked.value === 'Yes'
                    ? 'Could you please specify the amount of funds you have set aside to cover the administration fees and related expenses for the executor / administrator?'
                    : 'Could you please specify the amount of funds you will reserve to cover the administration fees and related expenses for the executor / administrator?';
            }
            const q6Checked = document.querySelector('input[name="q6"]:checked');
            if (q6Checked && q6Checked.value === 'Yes') q6Sub.style.display = 'block';
        });
    })();
</script>
</body>
</html>