<?php 
$activePage = 'settings';
$active = 'settings';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings · SmartWills</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; }

        /* ===== 页面头部 ===== */
        .settings-header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 0 30px;
            border-bottom: 2px solid #eef3f8;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .settings-header .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: linear-gradient(135deg, #fef0f0, #fde8e8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #b30707;
            flex-shrink: 0;
        }
        .settings-header .greeting h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a2c3e;
            margin: 0;
        }
        .settings-header .greeting p {
            color: #6f8ea3;
            font-size: .95rem;
            margin: 4px 0 0;
        }
        .settings-header .greeting p i {
            color: #b30707;
            margin-right: 4px;
        }

        /* ===== 卡片网格 ===== */
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 8px;
            align-items: stretch; /* 确保两列高度一致 */
        }

        /* ===== 卡片样式 ===== */
        .settings-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #eef2f8;
            padding: 28px 30px 30px;
            transition: box-shadow 0.25s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            /* 使用 Flex 列布局，让内容撑开，按钮固定在底部 */
            display: flex;
            flex-direction: column;
            height: 100%;  /* 撑满网格单元格 */
        }
        .settings-card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
            transform: translateY(-4px);
        }
        .settings-card .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a2c3e;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f4fa;
            flex-shrink: 0;
        }
        .settings-card .card-header i {
            color: #b30707;
            font-size: 1.2rem;
            width: 28px;
        }

        /* ===== 表单行 ===== */
        .setting-row {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 12px 0;
            border-bottom: 1px solid #f4f7fc;
        }
        .setting-row:last-child {
            border-bottom: none;
        }
        .setting-row .label {
            font-weight: 500;
            color: #4a6f8a;
            font-size: .82rem;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .setting-row .label i {
            color: #b30707;
            font-size: .8rem;
            width: 16px;
        }
        .setting-row input,
        .setting-row select {
            padding: 9px 16px;
            border: 1px solid #dce6ef;
            border-radius: 12px;
            font-size: .9rem;
            outline: none;
            background: #fafcfe;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }
        .setting-row input:focus,
        .setting-row select:focus {
            border-color: #b30707;
            box-shadow: 0 0 0 3px rgba(179,7,7,0.08);
            background: #fff;
        }
        .setting-row input::placeholder {
            color: #b0c4d8;
        }

        /* ===== 按钮组 - 底部对齐 ===== */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: auto;   /* 推到底部 */
            padding-top: 22px;
            flex-wrap: wrap;
            border-top: 1px solid #f0f4fa; /* 与卡片内容分隔 */
        }
        .btn {
            padding: 10px 28px;
            border-radius: 40px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: .9rem;
            transition: background 0.15s, transform 0.1s, box-shadow 0.15s;
        }
        .btn:active { transform: scale(0.97); }
        .btn-primary {
            background: #b30707;
            color: #fff;
            box-shadow: 0 4px 12px rgba(179,7,7,0.25);
        }
        .btn-primary:hover {
            background: #8f0505;
            box-shadow: 0 6px 20px rgba(179,7,7,0.35);
        }

        /* ===== 响应式 ===== */
        @media (max-width: 768px) {
            .settings-grid { grid-template-columns: 1fr; gap: 20px; }
            .settings-card { padding: 20px; }
            .settings-header .icon-box { width: 56px; height: 56px; font-size: 1.5rem; }
            .settings-header .greeting h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">

            <!-- 页面头部 -->
            <div class="settings-header">
                <div class="icon-box">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="greeting">
                    <h1>Settings</h1>
                    <p><i class="fas fa-cog"></i> Manage your account preferences and security</p>
                </div>
            </div>

            <!-- 卡片网格 -->
            <div class="settings-grid">

                <!-- Security 卡片 -->
                <div class="settings-card">
                    <div class="card-header">
                        <i class="fas fa-lock"></i> Security
                    </div>
                    <form id="passwordForm" onsubmit="event.preventDefault(); alert('🔐 Password updated (demo)');" style="display:flex; flex-direction:column; height:100%;">
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-key"></i> Current Password</span>
                            <input type="password" placeholder="Enter your current password" required>
                        </div>
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-lock"></i> New Password</span>
                            <input type="password" placeholder="Enter a strong new password" required>
                        </div>
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-check-circle"></i> Confirm Password</span>
                            <input type="password" placeholder="Re-enter your new password" required>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Personal Information 卡片 -->
                <div class="settings-card">
                    <div class="card-header">
                        <i class="fas fa-user-edit"></i> Personal Information
                    </div>
                    <form id="generalForm" onsubmit="event.preventDefault(); alert('✅ Personal information saved (demo)');" style="display:flex; flex-direction:column; height:100%;">
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-user"></i> Full Name</span>
                            <input type="text" placeholder="Enter your full name" value="John Doe">
                        </div>
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-birthday-cake"></i> Date of Birth</span>
                            <input type="date" placeholder="YYYY-MM-DD" value="1990-01-01">
                        </div>
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-id-badge"></i> Account ID</span>
                            <input type="text" placeholder="Your account ID" value="SW-10001" readonly style="background:#f4f7fc;cursor:not-allowed;">
                        </div>
                        <div class="setting-row">
                            <span class="label"><i class="fas fa-envelope"></i> Email</span>
                            <input type="email" placeholder="Enter your email" value="john.doe@example.com">
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
