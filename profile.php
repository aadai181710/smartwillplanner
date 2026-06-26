<?php 
$activePage = 'profile';
$active = 'profile';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile · SmartWills</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; }

        /* ===== 页面头部 ===== */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 0 30px;
            border-bottom: 2px solid #eef3f8;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .profile-header .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #b30707, #7a0404);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #fff;
            font-weight: 600;
            flex-shrink: 0;
        }
        .profile-header .greeting h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a2c3e;
            margin: 0;
        }
        .profile-header .greeting p {
            color: #6f8ea3;
            font-size: .95rem;
            margin: 4px 0 0;
        }
        .profile-header .greeting p i {
            color: #b30707;
            margin-right: 4px;
        }

        /* ===== 卡片网格 ===== */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 8px;
        }

        /* ===== 卡片样式 ===== */
        .profile-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #eef2f8;
            padding: 28px 30px 30px;
            transition: box-shadow 0.25s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        .profile-card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
            transform: translateY(-4px);
        }
        .profile-card .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a2c3e;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f4fa;
        }
        .profile-card .card-header i {
            color: #b30707;
            font-size: 1.2rem;
            width: 28px;
        }

        /* ===== 信息行 ===== */
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f4f7fc;
            align-items: baseline;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-row .label {
            width: 110px;
            font-weight: 500;
            color: #6f8ea3;
            font-size: .85rem;
            flex-shrink: 0;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .info-row .value {
            flex: 1;
            color: #1a2c3e;
            font-weight: 500;
            font-size: .95rem;
        }
        .info-row .value i {
            color: #b30707;
            margin-right: 6px;
            width: 18px;
        }

        /* ===== 按钮 ===== */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
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
        .btn-primary:hover { background: #8f0505; box-shadow: 0 6px 20px rgba(179,7,7,0.35); }
        .btn-outline {
            background: transparent;
            border: 1px solid #b30707;
            color: #b30707;
        }
        .btn-outline:hover { background: #fef0f0; }

        /* ===== 响应式 ===== */
        @media (max-width: 768px) {
            .profile-grid { grid-template-columns: 1fr; gap: 20px; }
            .profile-card { padding: 20px; }
            .profile-header .avatar { width: 60px; height: 60px; font-size: 1.6rem; }
            .profile-header .greeting h1 { font-size: 1.3rem; }
            .info-row { flex-wrap: wrap; }
            .info-row .label { width: 100%; margin-bottom: 2px; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">

            <!-- 页面头部（含头像） -->
            <div class="profile-header">
                <div class="avatar">JD</div>
                <div class="greeting">
                    <h1>My Profile</h1>
                    <p><i class="fas fa-user-check"></i> Welcome back, John Doe</p>
                </div>
            </div>

            <!-- 卡片网格 -->
            <div class="profile-grid">

                <!-- 个人信息卡片 -->
                <div class="profile-card">
                    <div class="card-header">
                        <i class="fas fa-id-card"></i> Personal Information
                    </div>
                    <div class="info-row">
                        <span class="label">Full Name</span>
                        <span class="value">John Doe</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Email</span>
                        <span class="value"><i class="fas fa-envelope"></i> john.doe@example.com</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Phone</span>
                        <span class="value"><i class="fas fa-phone"></i> +60 12-3456789</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Role</span>
                        <span class="value"><i class="fas fa-user-tag"></i> Administrator</span>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary" onclick="alert('📝 Update Profile (demo)')">
                            <i class="fas fa-edit"></i> Update Profile
                        </button>
                    </div>
                </div>

                <!-- 银行信息卡片 -->
                <div class="profile-card">
                    <div class="card-header">
                        <i class="fas fa-university"></i> Bank Account Information
                    </div>
                    <div class="info-row">
                        <span class="label">Bank Name</span>
                        <span class="value"><i class="fas fa-building"></i> Maybank</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Account Number</span>
                        <span class="value"><i class="fas fa-credit-card"></i> 1234 5678 9012</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Account Holder</span>
                        <span class="value">John Doe</span>
                    </div>
                    <div class="info-row">
                        <span class="label">SWIFT Code</span>
                        <span class="value">MBBEMYKL</span>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-outline" onclick="alert('🔧 Manage Bank Account (demo)')">
                            <i class="fas fa-cog"></i> Manage Account
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>