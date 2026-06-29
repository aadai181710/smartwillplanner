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

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .section-header h2 {
            margin: 0;
        }
        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .search-wrapper input[type="text"] {
            padding: 6px 14px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 0.9rem;
            outline: none;
            transition: border 0.2s;
        }
        .search-wrapper input[type="text"]:focus {
            border-color: #7f0004;
        }
        .search-wrapper button {
            background: #7f0004;
            border: none;
            color: #fff;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .search-wrapper button:hover {
            background: #a30006;
        }

        .tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }
        .tab {
            background: #f0f4f9;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            color: #2c3e50;
            cursor: pointer;
            transition: 0.2s;
        }
        .tab.active {
            background: #7f0004;
            color: #fff;
        }
        .tab:hover {
            background: #dce4ec;
        }
        .tab.active:hover {
            background: #7f0004;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
        }

        /* ----- Change the cards to Flex columns, and fix the buttons at the bottom. ----- */
        .course-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            border: 1px solid #eef2f8;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
            height: 100%;                /* Ensure the cards in the same row have equal height */
        }

        .course-image {
            height: 120px;
            background: #d9e2ec;
            border-radius: 12px;
            margin-bottom: 12px;
            background-image: linear-gradient(135deg, #c0d0e0 25%, #e0eaf2 50%, #c0d0e0 75%);
            background-size: 200% 200%;
            animation: shimmer 2s infinite;
            flex-shrink: 0;              /* Prevent the image from being compressed */
        }
        @keyframes shimmer {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }

        .course-card h4 {
            margin: 0 0 6px 0;
            font-size: 1.1rem;
        }
        .course-card p {
            margin: 0 0 12px 0;
            color: #555;
            font-size: 0.9rem;
            flex: 1;                    /* To occupy the remaining space, push the button to the bottom. */
        }
        .course-card button {
            background: #7f0004;
            color: #fff;
            border: none;
            padding: 6px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            align-self: flex-start;      /* Button aligns to the left, but all buttons are on the same horizontal line */
            margin-top: auto;            /* Ensure the button is fixed to the bottom */
        }
        .course-card button:hover {
            background: #a30006;
        }

        @media (max-width: 700px) {
            .hero-inner { flex-direction: column; align-items: flex-start; }
            .hero-right { margin-left: 0; margin-top: 16px; width: 100%; }
            .progress-card { min-width: unset; }
            .info-grid { flex-direction: column; }
            .section-header { flex-direction: column; align-items: stretch; gap: 10px; }
            .search-wrapper { justify-content: stretch; }
            .search-wrapper input[type="text"] { flex: 1; }
            .tabs { flex-wrap: wrap; }
            .course-grid { grid-template-columns: 1fr; }
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

            <!-- Course Catalogue With the search bar -->
            <div class="section-header">
                <h2>Course Catalogue</h2>
                <div class="search-wrapper">
                    <input type="text" placeholder="Search courses...">
                    <button><i class="fas fa-search"></i> Search</button>
                </div>
            </div>

            <!-- Tag bar -->
            <div class="tabs" id="tabContainer">
                <button class="tab" data-tab="all">All</button>
                <button class="tab active" data-tab="sg">SG</button>
                <button class="tab" data-tab="my">MY</button>
                <button class="tab" data-tab="th">TH</button>
                <button class="tab" data-tab="mywa">MYWA</button>
            </div>

            <!-- Course grid container -->
            <div class="course-grid" id="courseGrid">
                <!-- Dynamically rendered by JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
    // ---------- Course Data ----------
    const coursesData = {
        all: [
            { title: 'Legal Mastery', desc: 'Fundamentals of Singapore Wills', btn: 'Review' },
            { title: 'Trust & Legacy', desc: 'Inter Vivos Trust Model', btn: 'Resume' },
            { title: 'Estate Planning 101', desc: 'Introduction to Estate Planning', btn: 'Start' },
            { title: 'Advanced Will Drafting', desc: 'Complex Will Structures', btn: 'Enroll' }
        ],
        sg: [
            { title: 'Legal Mastery', desc: 'Fundamentals of Singapore Wills', btn: 'Review' },
            { title: 'Trust & Legacy', desc: 'Inter Vivos Trust Model', btn: 'Resume' },
            { title: 'Singapore Probate', desc: 'Probate Process in SG', btn: 'Learn' }
        ],
        my: [
            { title: 'Malaysian Estate Law', desc: 'Overview of Malaysian Wills', btn: 'Start' },
            { title: 'Islamic Estate Planning', desc: 'Faraid and Hibah', btn: 'Enroll' },
            { title: 'Trustee Duties (MY)', desc: 'Responsibilities under Malaysian Trusts', btn: 'Resume' }
        ],
        th: [
            { title: 'Thai Civil Code', desc: 'Estate Administration in Thailand', btn: 'Begin' },
            { title: 'Thai Wills & Inheritance', desc: 'Legal Requirements', btn: 'Study' },
            { title: 'Cross-Border Estate', desc: 'Thai-Singapore Comparison', btn: 'Review' }
        ],
        mywa: [
            { title: 'MYWA Certification', desc: 'Professional Will Writing', btn: 'Start' },
            { title: 'Ethics in Estate Planning', desc: 'Code of Conduct for MYWA', btn: 'Enroll' },
            { title: 'Advanced MYWA Practicum', desc: 'Case Studies & Applications', btn: 'Resume' }
        ]
    };

    // The default display is SG (the initial active value is SG).
    let currentTab = 'sg';

    function renderCourses(tabKey) {
        const grid = document.getElementById('courseGrid');
        const courses = coursesData[tabKey] || [];
        if (courses.length === 0) {
            grid.innerHTML = '<p style="grid-column:1/-1; text-align:center; color:#888;">No courses available for this category.</p>';
            return;
        }
        let html = '';
        courses.forEach(course => {
            html += `
                <div class="course-card">
                    <div class="course-image"></div>
                    <h4>${course.title}</h4>
                    <p>${course.desc}</p>
                    <button>${course.btn}</button>
                </div>
            `;
        });
        grid.innerHTML = html;
    }

    function setupTabs() {
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const tabKey = this.getAttribute('data-tab');
                currentTab = tabKey;
                renderCourses(tabKey);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderCourses('sg');
        setupTabs();
    });
</script>
</body>
</html>