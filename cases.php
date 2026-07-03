<?php $activePage = 'cases'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Case Management · SmartWills</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/cases.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
        <!-- /* ===== 全局重置 ===== */
        *{box-sizing:border-box}
        body{margin:0}
        .wrapper{display:flex;height:100vh;overflow:hidden}
        .sidebar{position:fixed;top:0;left:0;height:100vh;width:250px;overflow-y:auto;z-index:1000;background:#fff;border-right:1px solid #eef2f8}
        .main-content{margin-left:250px;display:flex;flex-direction:column;height:100vh;overflow:hidden;flex:1}
        .topbar{position:sticky;top:0;z-index:999;background:#fff;border-bottom:1px solid #eef2f8}
        .content{flex:1;overflow-y:auto;padding:20px 20px 0}

        /* ===== 组件 ===== */
        .page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px}
        .page-header h1{font-size:1.5rem;color:#000;margin:0}
        .btn-primary{background:#630202;color:#fff;border:none;padding:8px 22px;border-radius:30px;font-weight:600;cursor:pointer}
        .btn-primary:hover{background:#1a5f8a}

        .stats-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px;margin-bottom:24px}
        .stat-card{background:#fff;border-radius:16px;padding:16px 20px;border:1px solid #eef2f8;display:flex;align-items:center;gap:14px}
        .stat-card .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
        .stat-icon.blue{background:#e6f0fa;color:#a90404}
        .stat-icon.red{background:#fde8e8;color:#d9534f}
        .stat-icon.orange{background:#fef0e0;color:#f0ad4e}
        .stat-icon.green{background:#e0f0e6;color:#2a9d8f}
        .stat-icon.purple{background:#ede0f5;color:#8b5cf6}
        .stat-card .stat-number{font-size:1.5rem;font-weight:700;color:#1e466e}
        .stat-card .stat-label{font-size:.75rem;color:#6f8ea3}

        .toolbar{display:flex;gap:14px;margin-bottom:16px;flex-wrap:wrap}
        .toolbar .search-box{flex:1;min-width:200px;display:flex;align-items:center;background:#fff;border-radius:30px;padding:0 16px;border:1px solid #e0eaf2}
        .toolbar .search-box input{border:none;background:0 0;padding:8px 12px;width:100%;outline:0}
        .toolbar .filter-group{display:flex;gap:8px}
        .toolbar .filter-group select{padding:7px 14px;border-radius:30px;border:1px solid #e0eaf2;background:#fff;outline:0;cursor:pointer}

        .table-wrapper{background:#fff;border-radius:20px;border:1px solid #eef2f8;overflow:hidden}
        .table-scroll{overflow-x:auto;padding:0 20px 4px}
        .case-table{width:100%;border-collapse:collapse;font-size:.85rem}
        .case-table th{text-align:left;padding:14px 10px;font-weight:600;color:#4a6f8a;border-bottom:2px solid #eef2f8}
        .case-table td{padding:12px 10px;border-bottom:1px solid #f0f4fa}
        .case-table tr:hover{background:#f8fbfe}
        .case-id{font-weight:600;color:#1e466e}
        .client-name{display:flex;align-items:center;gap:8px;font-weight:500;color:#1e466e}
        .client-name .avatar{width:28px;height:28px;border-radius:50%;background:#e6f0fa;color:#2d7fb9;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.7rem}
        .status-badge{display:inline-block;padding:2px 12px;border-radius:30px;font-size:.7rem;font-weight:600}
        .status-badge.in-progress{background:#e6f0fa;color:#1f6390}
        .status-badge.in-review{background:#fef0e0;color:#b87a1f}
        .status-badge.completed{background:#e0f0e6;color:#1f7a5a}
        .status-badge.rejected{background:#fde8e8;color:#b33c3c}
        .status-badge.pending{background:#f5f0e0;color:#8a7a1f}

        .action-cell{display:flex;gap:6px;flex-wrap:wrap}
        .btn-sm{padding:4px 12px;border-radius:20px;border:none;font-weight:600;cursor:pointer;font-size:.75rem}
        .btn-sm.btn-edit{background:#e6f0fa;color:#1f6390}
        .btn-sm.btn-delete{background:#fde8e8;color:#b33c3c}
        .btn-sm.btn-view{background:#e0f0e6;color:#1f7a5a}

        footer{margin-top:20px;padding-top:10px;border-top:1px solid #e0eaf2;text-align:center;font-size:.65rem;color:#7c9ab3}

        /* ===== Modal ===== */
        #addModal,#editModal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;overflow-y:auto;padding:30px 20px}
        #addModal .modal-box,#editModal .modal-box{max-width:520px;margin:0 auto;background:#fff;border-radius:32px;padding:30px 35px;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
        .modal-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        .modal-head h2{font-size:1.5rem;color:#1a2c3e;margin:0}
        .modal-head h2 i{color:#b30707}
        .modal-head .close{background:0;border:0;font-size:1.8rem;cursor:pointer;color:#6f8ea3}
        .fsection{background:#f8fafd;border-radius:16px;padding:18px 22px;margin-bottom:16px}
        .frow{display:flex;gap:10px;margin-bottom:10px;flex-wrap:wrap;align-items:center}
        .frow label{font-weight:500;color:#0f3b5c;width:100px;font-size:.85rem;flex-shrink:0}
        .frow input,.frow select{flex:1;min-width:160px;padding:6px 12px;border:1px solid #d0dce8;border-radius:30px;font-size:.85rem;outline:0;background:#fff}
        .frow input:focus,.frow select:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .modal-btns{display:flex;justify-content:flex-end;gap:12px;margin-top:10px;flex-wrap:wrap}
        .modal-btns .btn{padding:8px 28px;border-radius:40px;font-weight:600;border:0;cursor:pointer;font-size:.9rem}
        .modal-btns .btn-cancel{background:#eef2f8;color:#2c4a66}
        .modal-btns .btn-cancel:hover{background:#dce4ed}
        .modal-btns .btn-save{background:#b30707;color:#fff}
        .modal-btns .btn-save:hover{background:#8f0505}

        /* ===== 响应式 ===== */
        @media(max-width:1024px){
            .stats-grid{grid-template-columns:repeat(3,1fr)}
            .stat-card{padding:14px 16px}
            .stat-card .stat-number{font-size:1.3rem}
        }
        @media(max-width:768px){
            .sidebar{width:200px}
            .main-content{margin-left:200px}
            .page-header{flex-direction:column;align-items:stretch}
            .page-header h1{font-size:1.3rem}
            .btn-primary{align-self:flex-start}
            .stats-grid{grid-template-columns:repeat(2,1fr);gap:12px}
            .stat-card{padding:12px 14px;gap:10px}
            .stat-card .stat-icon{width:36px;height:36px;font-size:1.1rem}
            .stat-card .stat-number{font-size:1.1rem}
            .stat-card .stat-label{font-size:.7rem}
            .toolbar{flex-direction:column;gap:10px}
            .toolbar .search-box{min-width:auto;width:100%}
            .toolbar .filter-group{width:100%}
            .toolbar .filter-group select{flex:1}
            .table-scroll{padding:0 12px 4px}
            .case-table{font-size:.75rem}
            .case-table th,.case-table td{padding:10px 6px}
            .client-name .avatar{width:24px;height:24px;font-size:.6rem}
            .action-cell{gap:4px}
            .btn-sm{padding:3px 8px;font-size:.65rem}
            .modal-box{padding:20px 18px}
            .frow{flex-direction:column;align-items:stretch}
            .frow label{width:auto}
            .frow input,.frow select{width:100%;min-width:0}
        }
        @media(max-width:480px){
            .page-header h1{font-size:1.1rem}
            .stats-grid{grid-template-columns:1fr 1fr;gap:8px}
            .stat-card{padding:10px 12px;gap:8px}
            .stat-card .stat-icon{width:30px;height:30px;font-size:.9rem;border-radius:8px}
            .stat-card .stat-number{font-size:1rem}
            .stat-card .stat-label{font-size:.65rem}
            .case-table{font-size:.7rem}
            .case-table th,.case-table td{padding:6px 4px}
            .btn-sm{padding:2px 6px;font-size:.6rem}
            .modal-head h2{font-size:1.2rem}
            .modal-btns .btn{padding:6px 18px;font-size:.8rem}
            .fsection{padding:12px 14px}
            .modal-box{padding:16px 14px}
        }
        @media(max-width:400px){
            .sidebar{width:140px}
            .main-content{margin-left:140px}
            .content{padding:8px 6px 0}
        }
    </style> -->
</head>
<body>
<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'layouts/topbar.php'; ?>
        <div class="content">
            <!-- 头部 -->
            <div class="page-header">
                <h1><i class="fas fa-gavel"></i> Case Management</h1>
                <button class="btn-primary" id="addCaseBtn"><i class="fas fa-plus"></i> Add Case</button>
            </div>

            <!-- 统计卡片 -->
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-spinner"></i></div><div><div class="stat-number" id="statInProgress">0</div><div class="stat-label">In Progress</div></div></div>
                <div class="stat-card"><div class="stat-icon orange"><i class="fas fa-search"></i></div><div><div class="stat-number" id="statInReview">0</div><div class="stat-label">In Review</div></div></div>
                <div class="stat-card"><div class="stat-icon green"><i class="fas fa-check-circle"></i></div><div><div class="stat-number" id="statCompleted">0</div><div class="stat-label">Completed</div></div></div>
                <div class="stat-card"><div class="stat-icon red"><i class="fas fa-times-circle"></i></div><div><div class="stat-number" id="statRejected">0</div><div class="stat-label">Rejected</div></div></div>
                <div class="stat-card"><div class="stat-icon purple"><i class="fas fa-clock"></i></div><div><div class="stat-number" id="statPending">0</div><div class="stat-label">Pending</div></div></div>
            </div>

            <!-- 工具栏 -->
            <div class="toolbar">
                <div class="search-box"><i class="fas fa-search"></i><input type="text" placeholder="Search by client / case ID" id="searchInput"></div>
                <div class="filter-group"><select id="filterStatus"><option value="all">All Status</option><option value="in-progress">In Progress</option><option value="in-review">In Review</option><option value="completed">Completed</option><option value="rejected">Rejected</option><option value="pending">Pending</option></select></div>
            </div>

            <!-- 表格 -->
            <div class="table-wrapper">
                <div class="table-scroll">
                    <table class="case-table">
                        <thead><tr><th>Case ID</th><th>Client</th><th>Case Type</th><th>Status</th><th>Submitted</th><th>Updated</th><th>Actions</th></tr></thead>
                        <tbody id="caseTableBody"></tbody>
                    </table>
                </div>
            </div>
            <footer>© 2026 smartwillsplanner.com</footer>
        </div>
    </div>
</div>

<!-- ===== Add Modal ===== -->
<div id="addModal">
    <div class="modal-box">
        <div class="modal-head"><h2><i class="fas fa-plus-circle"></i> Add New Case</h2><button class="close" onclick="closeAddModal()">&times;</button></div>
        <form id="addForm">
            <div class="fsection">
                <div class="frow"><label>Client Name</label><input type="text" id="addClientName" placeholder="Enter client name" required></div>
                <div class="frow"><label>Case Type</label><select id="addCaseType"><option value="Will">Will</option><option value="Trust">Trust</option><option value="LPA">LPA</option><option value="AMD">AMD</option></select></div>
                <div class="frow"><label>Status</label><select id="addStatus"><option value="in-progress">In Progress</option><option value="in-review">In Review</option><option value="completed">Completed</option><option value="rejected">Rejected</option><option value="pending">Pending</option></select></div>
            </div>
            <div class="modal-btns"><button type="button" class="btn btn-cancel" onclick="closeAddModal()">Cancel</button><button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Save Case</button></div>
        </form>
    </div>
</div>

<!-- ===== Edit Modal ===== -->
<div id="editModal">
    <div class="modal-box">
        <div class="modal-head"><h2><i class="fas fa-edit"></i> Edit Case</h2><button class="close" onclick="closeEditModal()">&times;</button></div>
        <form id="editForm">
            <input type="hidden" id="editCaseId">
            <div class="fsection">
                <div class="frow"><label>Client Name</label><input type="text" id="editClientName" placeholder="Enter client name" required></div>
                <div class="frow"><label>Case Type</label><select id="editCaseType"><option value="Will">Will</option><option value="Trust">Trust</option><option value="LPA">LPA</option><option value="AMD">AMD</option></select></div>
                <div class="frow"><label>Status</label><select id="editStatus"><option value="in-progress">In Progress</option><option value="in-review">In Review</option><option value="completed">Completed</option><option value="rejected">Rejected</option><option value="pending">Pending</option></select></div>
            </div>
            <div class="modal-btns"><button type="button" class="btn btn-cancel" onclick="closeEditModal()">Cancel</button><button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Update Case</button></div>
        </form>
    </div>
</div>

<script>
// ========== Data ==========
let cases = [
    { id: 1, client: 'Zhang Wei', type: 'Will', status: 'in-progress', submitted: '2026-06-10', updated: '2026-06-12' },
    { id: 2, client: 'Li Fang', type: 'Trust', status: 'completed', submitted: '2026-06-05', updated: '2026-06-09' },
    { id: 3, client: 'Wang Qiang', type: 'LPA', status: 'pending', submitted: '2026-06-15', updated: '2026-06-15' },
    { id: 4, client: 'Chen Mei', type: 'Will', status: 'in-review', submitted: '2026-06-12', updated: '2026-06-14' },
    { id: 5, client: 'Liu Yang', type: 'AMD', status: 'rejected', submitted: '2026-06-08', updated: '2026-06-11' }
];
let nextId = 6;

// ========== Helpers ==========
const statusDisplay = s => ({ 'in-progress':'In Progress','in-review':'In Review','completed':'Completed','rejected':'Rejected','pending':'Pending' }[s]||s);
const statusClass = s => 'status-badge ' + s;

// ========== Render ==========
function render(data) {
    const tbody = document.getElementById('caseTableBody');
    if (!data.length) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:40px;color:#8aa4bc;">No cases found</td></tr>';
        updateStats([]);
        return;
    }
    tbody.innerHTML = data.map(c => `
        <tr>
            <td><span class="case-id">#${c.id}</span></td>
            <td><div class="client-name"><span class="avatar">${c.client.charAt(0)}</span>${c.client}</div></td>
            <td>${c.type}</td>
            <td><span class="${statusClass(c.status)}">${statusDisplay(c.status)}</span></td>
            <td>${c.submitted}</td>
            <td>${c.updated}</td>
            <td>
                <div class="action-cell">
                    <button class="btn-sm btn-view" data-id="${c.id}"><i class="fas fa-eye"></i> View</button>
                    <button class="btn-sm btn-edit" data-id="${c.id}"><i class="fas fa-edit"></i> Edit</button>
                    <button class="btn-sm btn-delete" data-id="${c.id}"><i class="fas fa-trash-alt"></i> Delete</button>
                </div>
            </td>
        </tr>
    `).join('');

    tbody.querySelectorAll('[data-id]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            const c = cases.find(x => x.id === id);
            if (!c) return;
            if (this.classList.contains('btn-view')) alert('📄 View case #' + id + ' for ' + c.client + ' (demo)');
            else if (this.classList.contains('btn-edit')) openEditModal(id);
            else if (this.classList.contains('btn-delete') && confirm('Delete case #' + id + ' for ' + c.client + '?')) {
                cases = cases.filter(x => x.id !== id);
                render(cases);
                updateStats(cases);
            }
        });
    });
    updateStats(data);
}

function updateStats(data) {
    const counts = { 'in-progress':0, 'in-review':0, 'completed':0, 'rejected':0, 'pending':0 };
    data.forEach(c => { if (counts.hasOwnProperty(c.status)) counts[c.status]++; });
    document.getElementById('statInProgress').textContent = counts['in-progress'];
    document.getElementById('statInReview').textContent = counts['in-review'];
    document.getElementById('statCompleted').textContent = counts['completed'];
    document.getElementById('statRejected').textContent = counts['rejected'];
    document.getElementById('statPending').textContent = counts['pending'];
}

// ========== Filter ==========
function filterCases() {
    const keyword = document.getElementById('searchInput').value.trim().toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;
    const filtered = cases.filter(c => 
        (c.client.toLowerCase().includes(keyword) || c.id.toString().includes(keyword)) &&
        (statusFilter === 'all' || c.status === statusFilter)
    );
    render(filtered);
}
document.getElementById('searchInput').addEventListener('input', filterCases);
document.getElementById('filterStatus').addEventListener('change', filterCases);

// ========== Add ==========
document.getElementById('addCaseBtn').addEventListener('click', () => { document.getElementById('addModal').style.display = 'block'; document.body.style.overflow = 'hidden'; });
function closeAddModal() { document.getElementById('addModal').style.display = 'none'; document.body.style.overflow = 'auto'; }
document.getElementById('addModal').addEventListener('click', e => { if (e.target === this) closeAddModal(); });
document.getElementById('addForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const client = document.getElementById('addClientName').value.trim();
    if (!client) { alert('Please enter client name.'); return; }
    const today = new Date().toISOString().slice(0,10);
    cases.push({ id: nextId++, client, type: document.getElementById('addCaseType').value, status: document.getElementById('addStatus').value, submitted: today, updated: today });
    closeAddModal();
    document.getElementById('addForm').reset();
    filterCases();
    alert('✅ Case added for ' + client);
});

// ========== Edit ==========
function openEditModal(id) {
    const c = cases.find(x => x.id === id);
    if (!c) return;
    document.getElementById('editCaseId').value = c.id;
    document.getElementById('editClientName').value = c.client;
    document.getElementById('editCaseType').value = c.type;
    document.getElementById('editStatus').value = c.status;
    document.getElementById('editModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}
function closeEditModal() { document.getElementById('editModal').style.display = 'none'; document.body.style.overflow = 'auto'; }
document.getElementById('editModal').addEventListener('click', e => { if (e.target === this) closeEditModal(); });
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = parseInt(document.getElementById('editCaseId').value);
    const c = cases.find(x => x.id === id);
    if (!c) return;
    const client = document.getElementById('editClientName').value.trim();
    if (!client) { alert('Please enter client name.'); return; }
    c.client = client;
    c.type = document.getElementById('editCaseType').value;
    c.status = document.getElementById('editStatus').value;
    c.updated = new Date().toISOString().slice(0,10);
    closeEditModal();
    filterCases();
    alert('✅ Case #' + id + ' updated');
});

// ========== Init ==========
render(cases);
</script>
<script src="assets/js/global.js"></script>
</body>
</html>