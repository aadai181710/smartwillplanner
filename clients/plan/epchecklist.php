<?php
$activePage = 'clients';
// Get client ID from URL parameter
$clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clientName = $clientId ? 'Client #' . $clientId : 'Unspecified Client';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estate Planning Checklist · SmartWills</title>
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

        /* Checklist 铺满宽度（去除居中限制） */
        .checklist-wrapper {
            width: 100%;
            max-width: none;
            margin: 0;
            background: #ffffff;
            border-radius: 32px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            padding: 24px 30px 30px;
            transition: 0.2s;
        }
        @media (max-width: 600px) {
            .checklist-wrapper {
                padding: 20px 18px;
            }
        }

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

        .question-group {
            margin-bottom: 28px;
            border-bottom: 1px dashed #e6edf4;
            padding-bottom: 22px;
        }
        .question-group:last-of-type {
            border-bottom: none;
        }
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
        .sub-question .question-text {
            font-weight: 500;
            color: #1e466e;
        }
        .sub-question .options-group {
            gap: 16px;
        }
        .text-input {
            margin-top: 10px;
        }
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
        .btn-next {
            background: #b30707;
            color: #fff;
        }
        .btn-next:hover {
            background: #8f0505;
        }
        @media (max-width: 480px) {
            .btn-row {
                flex-direction: column;
                align-items: stretch;
            }
            .btn {
                justify-content: center;
            }
            .text-input input {
                max-width: 100%;
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
            <div class="checklist-wrapper">
                <div class="header">
                    <h1><i class="fas fa-clipboard-list"></i> Estate Planning Checklist</h1>
                    <!-- 客户信息区域（无背景框） -->
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

                <form id="checklistForm" method="POST" action="reviewresources.php">
                    <input type="hidden" name="client_id" value="<?php echo $clientId; ?>">

                    <div class="question-group">
                        <div class="question-text"><span class="qnum">1</span> Have you created an estate plan to ensure your assets are distributed according to your wishes and benefit your loved ones?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q1" value="Yes"> Yes</label>
                            <label><input type="radio" name="q1" value="No"> No</label>
                        </div>
                    </div>

                    <div class="question-group">
                        <div class="question-text"><span class="qnum">2</span> Do you know that your assets might be frozen whether or not you have a Will?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q2" value="Yes, I am aware"> Yes, I am aware</label>
                            <label><input type="radio" name="q2" value="No, I am not aware"> No, I am not aware</label>
                        </div>
                    </div>

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

                    <div class="question-group">
                        <div class="question-text"><span class="qnum">4</span> Are you aware that your executor or administrator will need to settle all outstanding debts and taxes before they can distribute the estate to your beneficiaries?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q4" value="I am aware"> I am aware</label>
                            <label><input type="radio" name="q4" value="I am not aware"> I am not aware</label>
                        </div>
                    </div>

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

                    <div class="question-group">
                        <div class="question-text"><span class="qnum">7</span> Would you like to understand how much funding is necessary to protect a family and estate in the event of someone's passing?</div>
                        <div class="options-group">
                            <label><input type="radio" name="q7" value="Yes"> Yes</label>
                            <label><input type="radio" name="q7" value="No"> No</label>
                        </div>
                    </div>

                    <div class="btn-row">
                        <!-- 修改：按钮文字改为 "Back to My Assets"，跳转到 myassets.php 并携带客户 ID -->
                        <button type="button" class="btn btn-back" onclick="window.location.href='myassets.php?id=<?php echo $clientId; ?>';">
                            <i class="fas fa-arrow-left"></i> Back to My Assets
                        </button>
                        <button type="submit" class="btn btn-next">Go to Estate Fund Need Analysis</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const q3Radios = document.querySelectorAll('.q3_radio');
        const q3YesSub = document.getElementById('q3_yes_sub');
        const q3NoSub = document.getElementById('q3_no_sub');
        q3Radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Yes') {
                    q3YesSub.style.display = 'block';
                    q3NoSub.style.display = 'none';
                } else if (this.value === 'No') {
                    q3YesSub.style.display = 'none';
                    q3NoSub.style.display = 'block';
                }
            });
        });

        const q5Radios = document.querySelectorAll('.q5_radio');
        const q5_1_group = document.getElementById('q5_1_group');
        const q5_1_label = document.getElementById('q5_1_label');
        q5Radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Yes' || this.value === 'No') {
                    q5_1_group.style.display = 'block';
                    if (this.value === 'Yes') {
                        q5_1_label.textContent = 'Could you please specify the amount of funds you have set aside to cover the administration fees and related expenses for the executor / administrator?';
                    } else {
                        q5_1_label.textContent = 'Could you please specify the amount of funds you will reserve to cover the administration fees and related expenses for the executor / administrator?';
                    }
                }
            });
        });

        const q6Radios = document.querySelectorAll('.q6_radio');
        const q6Sub = document.getElementById('q6_sub');
        q6Radios.forEach(radio => {
            radio.addEventListener('change', function() {
                q6Sub.style.display = (this.value === 'Yes') ? 'block' : 'none';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const q3Checked = document.querySelector('input[name="q3"]:checked');
            if (q3Checked) {
                if (q3Checked.value === 'Yes') {
                    q3YesSub.style.display = 'block';
                } else if (q3Checked.value === 'No') {
                    q3NoSub.style.display = 'block';
                }
            }

            const q5Checked = document.querySelector('input[name="q5_funds"]:checked');
            if (q5Checked) {
                q5_1_group.style.display = 'block';
                if (q5Checked.value === 'Yes') {
                    q5_1_label.textContent = 'Could you please specify the amount of funds you have set aside to cover the administration fees and related expenses for the executor / administrator?';
                } else {
                    q5_1_label.textContent = 'Could you please specify the amount of funds you will reserve to cover the administration fees and related expenses for the executor / administrator?';
                }
            }

            const q6Checked = document.querySelector('input[name="q6"]:checked');
            if (q6Checked && q6Checked.value === 'Yes') {
                q6Sub.style.display = 'block';
            }
        });
    })();
</script>
</body>
</html>