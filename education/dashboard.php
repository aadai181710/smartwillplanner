<?php
$activePage = 'education';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Education Dashboard</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .hero-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .hero-right {
            flex-shrink: 0;
            margin-left: 30px;
            min-width: 200px;
        }
        .progress-card {
            border: 2px solid #e0eaf2;
            border-radius: 16px;
            padding: 18px 22px;
            background: #fde8e8;  
            min-width: 220px;
        }
      
        .progress-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 6px;
        }

        .progress-header .label {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0b0e11;
            letter-spacing: 0.3px;
            text-align: left;     
        }

        .progress-header .percentage {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0b0e11;
            line-height: 1.2;
            text-align: right;   
            margin-top: -4px;      
        }
        .progress-track {
            width: 100%;
            height: 10px;
            background: #d0d8e0;
            border-radius: 6px;
            overflow: hidden;
            margin: 6px 0 8px 0;
        }
        .progress-fill {
            height: 100%;
            width: 80%;
            background: #7f0004;
            border-radius: 6px;
        }
        .progress-desc {
            font-size: 0.85rem;
            color: #1d1d1d;
            margin: 0;
        }
        .progress-desc strong {
            color: #1a2c3e;
            font-weight: 600;
        }

        .info-grid {
            display: flex;
            gap: 24px;
            margin-bottom: 30px;
        }
        .info-card {
            flex: 1;
            background: #fff;
            border-radius: 16px;
            padding: 20px 24px;
            border: 1px solid #eef2f8;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .info-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #0e0e0e;
            margin: 0 0 8px 0;
        }
        .info-card p {
            font-size: 0.9rem;
            color: #575757;
            margin: 0;
        }

        @media (max-width: 700px) {
            .hero-inner { flex-direction: column; align-items: flex-start; }
            .hero-right { margin-left: 0; margin-top: 16px; width: 100%; }
            .progress-card { min-width: unset; }
            .info-grid { flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../layouts/topbar.php'; ?>
        <div class="content">
            <div class="hero-banner">
                <div class="hero-inner">
                    <div class="hero-left">
                        <h5>EDUCATION CENTER</h5>
                        <h1>Welcome Back, Ahmad</h1>
                        <p>Continue your estate planning certification journey.</p>
                    </div>
                    <div class="hero-right">
                        <div class="progress-card">
                            <div class="progress-header">
                                <span class="label">Current Learning</span>
                                <span class="percentage">80%</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill"></div>
                            </div>
                            <p class="progress-desc">
                                <strong>Progress</strong> &nbsp; 4 of 5 Core Certifications Complete
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h3>Announcement & Update</h3>
                    <p>No new announcements</p>
                </div>
                <div class="info-card">
                    <h3>Upcoming Events & Training</h3>
                    <p>No upcoming events</p>
                </div>
            </div>

            <div class="section-header">
                <h2>Course Catalogue</h2>
            </div>
            <div class="tabs">
                <button class="tab active">SG</button>
                <button class="tab">MY</button>
                <button class="tab">TH</button>
            </div>
            <div class="course-grid">
                <div class="course-card">
                    <div class="course-image"></div>
                    <h4>Legal Mastery</h4>
                    <p>Fundamentals of Singapore Wills</p>
                    <button>Review</button>
                </div>
                <div class="course-card">
                    <div class="course-image"></div>
                    <h4>Trust & Legacy</h4>
                    <p>Inter Vivos Trust Model</p>
                    <button>Resume</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>