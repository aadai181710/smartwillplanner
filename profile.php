<?php 
$activePage = 'profile';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>My Profile · SmartWills</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">

            <!-- 页面头部 -->
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
                    <div class="card-header"><i class="fas fa-id-card"></i> Personal Information</div>
                    <div class="info-row"><span class="label">Full Name</span><span class="value">John Doe</span></div>
                    <div class="info-row"><span class="label">Email</span><span class="value"><i class="fas fa-envelope"></i> john.doe@example.com</span></div>
                    <div class="info-row"><span class="label">Phone</span><span class="value"><i class="fas fa-phone"></i> +60 12-3456789</span></div>
                    <div class="info-row"><span class="label">Role</span><span class="value"><i class="fas fa-user-tag"></i> Administrator</span></div>
                    <div class="btn-group">
                        <button class="btn btn-primary" onclick="alert('📝 Update Profile (demo)')"><i class="fas fa-edit"></i> Update Profile</button>
                    </div>
                </div>

                <!-- 银行信息卡片 -->
                <div class="profile-card">
                    <div class="card-header"><i class="fas fa-university"></i> Bank Account Information</div>
                    <div class="info-row"><span class="label">Bank Name</span><span class="value"><i class="fas fa-building"></i> Maybank</span></div>
                    <div class="info-row"><span class="label">Account Number</span><span class="value"><i class="fas fa-credit-card"></i> 1234 5678 9012</span></div>
                    <div class="info-row"><span class="label">Account Holder</span><span class="value">John Doe</span></div>
                    <div class="info-row"><span class="label">SWIFT Code</span><span class="value">MBBEMYKL</span></div>
                    <div class="btn-group">
                        <button class="btn btn-outline" onclick="alert('🔧 Manage Bank Account (demo)')"><i class="fas fa-cog"></i> Manage Account</button>
                    </div>
                </div>

        </div>
    </div>
</div>
<script src="assets/js/global.js"></script>
</body>
</html>