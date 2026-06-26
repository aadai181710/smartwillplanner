<div class="sidebar">

    <div class="sidebar-header">

        <img
            src="/assets/images/smartwills-logo.png"
            alt="SmartWills Logo"
            class="logo-image"
        >

        <div class="domain">
            smartwillsplanner.com
        </div>

    </div>

    <div class="sidebar-menu">

        <a href="/index.php"
        class="menu-item <?= ($activePage == 'dashboard') ? 'active' : ''; ?>">
            Dashboard
        </a>

        <a href="/clients/clients.php"
        class="menu-item <?= ($activePage == 'clients') ? 'active' : ''; ?>">
            Clients
        </a>

        <a href="/cases.php"
        class="menu-item <?= ($activePage == 'cases') ? 'active' : ''; ?>">
            Cases
        </a>

        <a href="/tools.php"
        class="menu-item <?= ($activePage == 'tools') ? 'active' : ''; ?>">
            Tools
        </a>

        <a href="/education/dashboard.php"
        class="menu-item <?= ($activePage == 'education') ? 'active' : ''; ?>">
            Education
        </a>

        <a href="/resources.php"
        class="menu-item <?= ($activePage == 'resources') ? 'active' : ''; ?>">
            Resources
        </a>

        <a href="/salesreport.php"
        class="menu-item <?= ($activePage == 'salesreport') ? 'active' : ''; ?>">
            Sales Report
        </a>




    </div>

    <div class="sidebar-footer">
        <a href="/profile.php" class="menu-item <?= ($activePage == 'profile') ? 'active' : ''; ?>">My Profile</a>
        <a href="/settings.php" class="menu-item <?= ($activePage == 'settings') ? 'active' : ''; ?>">Settings</a>
    </div>

</div>