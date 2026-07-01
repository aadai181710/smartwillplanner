<?php $activePage = 'clients'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Clients · SmartWills</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ----- 原有样式（保持不变） ----- */
        .page-header{display:flex;align-items:center;gap:15px;margin-bottom:20px;flex-wrap:wrap}
        .page-header h1{font-size:1.5rem;color:#000;margin:0}
        .btn-primary{background:#630202;color:#fff;border:none;padding:8px 22px;border-radius:30px;font-weight:600;cursor:pointer}
        .btn-primary:hover{background:#1a5f8a}
        .btn-total{
            background:transparent;
            color:#1f6390;
            border:none;
            padding:6px 18px;
            border-radius:30px;
            font-weight:600;
            cursor:pointer;
            display:inline-flex;
            align-items:center;
            gap:8px;
            font-size:1rem;
            transition:background .2s;
            white-space:nowrap;
            margin:0 8px;
        }
        .btn-total .num{font-size:1.3rem;font-weight:700;color:#0f4a70}
        .btn-total .label{font-size:.75rem;font-weight:500;color:#4a7a9a;letter-spacing:.5px}
        .btn-total i{font-size:1.1rem;color:#4a7a9a}
        .btn-total:hover{background:#d0e4f2}
        .btn-total:active{transform:scale(.97)}
        .toolbar{display:flex;gap:14px;margin-bottom:16px;flex-wrap:wrap}
        .toolbar .search-box{flex:1;min-width:200px;display:flex;align-items:center;background:#fff;border-radius:30px;padding:0 16px;border:1px solid #e0eaf2}
        .toolbar .search-box input{border:none;background:0 0;padding:8px 12px;width:100%;outline:0}
        .toolbar .filter-group{display:flex;gap:8px}
        .toolbar .filter-group select{padding:7px 14px;border-radius:30px;border:1px solid #e0eaf2;background:#fff;outline:0;cursor:pointer}
        .table-wrapper{background:#fff;border-radius:20px;border:1px solid #eef2f8;overflow:hidden}
        .table-scroll{overflow-x:auto;padding:0 20px 4px}
        .client-table{width:100%;border-collapse:collapse;font-size:.85rem}
        .client-table th{text-align:left;padding:14px 10px;font-weight:600;color:#4a6f8a;border-bottom:2px solid #eef2f8}
        .client-table td{padding:12px 10px;border-bottom:1px solid #f0f4fa}
        .client-table tr:hover{background:#f8fbfe}
        .client-name{display:flex;align-items:center;gap:8px;font-weight:600;color:#1e466e}
        .client-name .avatar{width:30px;height:30px;border-radius:50%;background:#e6f0fa;color:#2d7fb9;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.75rem}
        .risk-badge{display:inline-block;padding:2px 12px;border-radius:30px;font-size:.7rem;font-weight:700}
        .risk-badge.low{background:#e0f0e6;color:#1f7a5a}
        .risk-badge.moderate{background:#fef0e0;color:#b87a1f}
        .risk-badge.high{background:#fde8e8;color:#b33c3c}
        .status-badge{display:inline-block;padding:2px 12px;border-radius:30px;font-size:.7rem;font-weight:600}
        .status-badge.active{background:#e6f0fa;color:#1f6390}
        .status-badge.done{background:#e0f0e6;color:#1f7a5a}
        .status-badge.pending{background:#f5f0e0;color:#8a7a1f}
        .action-cell{display:flex;gap:6px;flex-wrap:wrap}
        .btn-sm{padding:4px 12px;border-radius:20px;border:none;font-weight:600;cursor:pointer;font-size:.75rem}
        .btn-sm.btn-edit{background:#e6f0fa;color:#1f6390}
        .btn-sm.btn-delete{background:#fde8e8;color:#b33c3c}
        .btn-sm.btn-plan{background:#dff0e6;color:#1f7a5a}
        .btn-sm.btn-risk-analyze{background:#f0e6fa;color:#7a3f9e}
        footer{margin-top:20px;padding-top:10px;border-top:1px solid #e0eaf2;text-align:center;font-size:.65rem;color:#7c9ab3}
        #editModal, #riskModal, #addModal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;overflow-y:auto;padding:30px 20px}
        .modal-box{max-width:960px;margin:0 auto;background:#fff;border-radius:32px;padding:30px 35px;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
        #riskModal .modal-box{max-width:820px}
        #addModal .modal-box{max-width:500px}
        .modal-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:2px solid #eef3f8;padding-bottom:14px}
        #riskModal .modal-head{margin-bottom:16px}
        .modal-head h2{font-size:1.5rem;color:#1a2c3e}
        #riskModal .modal-head h2{font-size:1.4rem}
        .modal-head h2 i{color:#b30707}
        #riskModal .modal-head h2 i{color:#7a3f9e}
        .modal-head .close{background:0;border:0;font-size:1.8rem;cursor:pointer;color:#6f8ea3}
        .fsection{background:#f8fafd;border-radius:16px;padding:18px 22px;margin-bottom:16px}
        .fsection h3{font-size:1.05rem;color:#1a2c3e;margin-bottom:12px}
        .fsection h3 i{color:#b30707}
        .frow{display:flex;gap:10px;margin-bottom:10px;flex-wrap:wrap;align-items:center}
        .frow label{font-weight:500;color:#0f3b5c;width:130px;font-size:.85rem;flex-shrink:0}
        .frow input,.frow select{flex:1;min-width:160px;padding:6px 12px;border:1px solid #d0dce8;border-radius:30px;font-size:.85rem;outline:0;background:#fff}
        .frow input:focus,.frow select:focus{border-color:#b30707;box-shadow:0 0 0 3px rgba(179,7,7,0.1)}
        .frow .ig{display:flex;gap:12px;flex-wrap:wrap;align-items:center}
        .frow .ig label{width:auto;font-weight:400;font-size:.8rem;display:flex;align-items:center;gap:4px;cursor:pointer}
        .frow .ig input[type="radio"],.frow .ig input[type="checkbox"]{width:15px;height:15px;accent-color:#b30707;margin:0}
        .frow .small{flex:0.3;min-width:70px}
        .frow .half{flex:0.5;min-width:100px}
        .fsection .sub-title{font-weight:600;color:#0f3b5c;font-size:.85rem;margin:8px 0 6px}
        .modal-btns{display:flex;justify-content:flex-end;gap:12px;margin-top:10px;flex-wrap:wrap}
        .modal-btns .btn{padding:8px 28px;border-radius:40px;font-weight:600;border:0;cursor:pointer;font-size:.9rem}
        .modal-btns .btn-cancel{background:#eef2f8;color:#2c4a66}
        .modal-btns .btn-cancel:hover{background:#dce4ed}
        .modal-btns .btn-save{background:#b30707;color:#fff}
        .modal-btns .btn-save:hover{background:#8f0505}
        #riskModal .modal-body .intro-text{font-size:.92rem;color:#1a2c3e;margin-bottom:18px;background:transparent;border:none;padding:0}
        #riskModal .risk-section{background:#fafcfe;border-radius:14px;padding:14px 18px;margin-bottom:14px;border:1px solid #eef2f8}
        #riskModal .risk-section h3{font-size:.95rem;color:#1a2c3e;margin-bottom:10px;font-weight:600;border-bottom:1px dashed #e0eaf2;padding-bottom:8px}
        #riskModal .risk-section h3 i{color:#7a3f9e;margin-right:6px}
        #riskModal .risk-section .ck-item{display:flex;align-items:flex-start;gap:8px;margin-bottom:6px;padding:3px 4px;font-size:.82rem;color:#1f3a52;line-height:1.4}
        #riskModal .risk-section .ck-item input[type="checkbox"]{width:16px;height:16px;margin-top:2px;accent-color:#7a3f9e;flex-shrink:0;cursor:pointer}
        #riskModal .risk-section .ck-item label{cursor:pointer;flex:1}
        #riskModal .risk-section .ck-item:hover{background:#f0f4fa;border-radius:6px}
        #riskModal .modal-btns .btn-save-risk{background:#7a3f9e;color:#fff}
        #riskModal .modal-btns .btn-save-risk:hover{background:#5f2f7a}
        /* 风险结果样式（用于结果展示） */
        .risk-result { padding: 10px 0; }
        .risk-result h3 { font-size:1.2rem; color:#1a2c3e; margin-bottom:5px; }
        .risk-result .score-display { font-size:2.2rem; font-weight:700; color:#1a2c3e; margin:10px 0 5px; }
        .risk-result .risk-level { font-size:1.3rem; font-weight:600; margin-bottom:15px; padding:6px 18px; border-radius:40px; display:inline-block; }
        .risk-result .risk-level.low { background:#e0f0e6; color:#1f7a5a; }
        .risk-result .risk-level.moderate { background:#fef0e0; color:#b87a1f; }
        .risk-result .risk-level.high { background:#fde8e8; color:#b33c3c; }
        .risk-result .desc { background:#f8fafd; border-radius:16px; padding:18px 22px; margin-top:15px; font-size:0.95rem; line-height:1.6; color:#1f3a52; }

        /* ===== 响应式设计 ===== */
        /* 平板及以下 */
        @media (max-width: 1024px) {
            .page-header h1 { font-size: 1.3rem; }
            .btn-primary { padding: 6px 18px; font-size: .9rem; }
            .stat-card { padding: 14px; }
        }

        /* 手机横屏 / 小平板 */
        @media (max-width: 768px) {
            .page-header { flex-wrap: wrap; gap: 10px; }
            .page-header h1 { font-size: 1.2rem; }
            .btn-primary { padding: 6px 14px; font-size: .85rem; }
            .btn-total { padding: 4px 12px; font-size: .9rem; }
            .btn-total .num { font-size: 1.1rem; }
            .btn-total .label { font-size: .65rem; }

            .toolbar { flex-direction: column; align-items: stretch; gap: 10px; }
            .toolbar .search-box { width: 100%; }
            .filter-group { display: flex; gap: 8px; }
            .filter-group select { flex: 1; }

            .table-scroll { padding: 0 10px 4px; }
            .client-table { font-size: .75rem; }
            .client-table th, .client-table td { padding: 8px 6px; }
            .client-name .avatar { width: 24px; height: 24px; font-size: .65rem; }
            .risk-badge, .status-badge { font-size: .6rem; padding: 1px 8px; }
            .action-cell { gap: 4px; }
            .btn-sm { font-size: .65rem; padding: 2px 8px; }

            .modal-box { padding: 20px; margin: 10px; }
            #riskModal .modal-box { max-width: 100%; }
            #addModal .modal-box { max-width: 100%; }
            .modal-head h2 { font-size: 1.2rem; }
            #riskModal .modal-head h2 { font-size: 1.2rem; }
            .modal-head .close { font-size: 1.5rem; }

            .fsection { padding: 14px 16px; }
            .frow { flex-direction: column; align-items: stretch; }
            .frow label { width: auto; }
            .frow input, .frow select { width: 100%; min-width: 0; }
            .frow .ig { flex-direction: column; align-items: flex-start; }

            .modal-btns .btn { padding: 6px 20px; font-size: .8rem; }
            .risk-result .score-display { font-size: 1.8rem; }
            .risk-result .risk-level { font-size: 1.1rem; padding: 4px 14px; }
            .risk-result .desc { padding: 14px 16px; font-size: .85rem; }
        }

        /* 小屏手机 */
        @media (max-width: 480px) {
            .page-header h1 { font-size: 1rem; }
            .btn-primary { padding: 5px 12px; font-size: .75rem; }
            .btn-total { padding: 3px 8px; font-size: .8rem; margin: 0 4px; }
            .btn-total .num { font-size: 1rem; }
            .btn-total .label { font-size: .6rem; }

            .client-table { font-size: .7rem; }
            .client-table th, .client-table td { padding: 6px 4px; }
            .client-name .avatar { width: 20px; height: 20px; font-size: .55rem; }
            .risk-badge, .status-badge { font-size: .55rem; padding: 1px 6px; }
            .btn-sm { font-size: .6rem; padding: 2px 6px; }

            .modal-box { padding: 16px; }
            .modal-head h2 { font-size: 1rem; }
            .modal-btns .btn { padding: 5px 16px; font-size: .75rem; }
            .fsection { padding: 12px; }
            .fsection h3 { font-size: .95rem; }

            .risk-result .score-display { font-size: 1.6rem; }
            .risk-result .risk-level { font-size: 1rem; padding: 3px 12px; }
            .risk-result .desc { padding: 12px 14px; font-size: .8rem; }
            #riskModal .risk-section .ck-item { font-size: .75rem; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../layouts/topbar.php'; ?>
        <div class="content">
            <div class="page-header">
                <h1><i class="fas fa-users"></i> Client Management</h1>
                <button class="btn-total" onclick="alert('Total clients: 42')">
                    <i class="fas fa-user-friends"></i>
                    <span class="num">42</span>
                    <span class="label">Total</span>
                </button>
                <button class="btn-primary" id="addClientBtn" style="margin-left:auto;"><i class="fas fa-plus"></i> Add Client</button>
            </div>
            <div class="toolbar">
                <div class="search-box"><i class="fas fa-search"></i><input type="text" placeholder="Search by name / phone" id="searchInput"></div>
                <div class="filter-group">
                    <select id="filterRisk"><option value="all">All Risks</option><option value="low">Low</option><option value="moderate">Moderate</option><option value="high">High</option></select>
                    <select id="filterStatus"><option value="all">All Status</option><option value="active">Active</option><option value="done">Completed</option><option value="pending">Pending</option></select>
                </div>
            </div>
            <div class="table-wrapper">
                <div class="table-scroll">
                    <table class="client-table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Contact</th>
                                <th>Risk</th>
                                <th>Status</th>
                                <th>Updated</th>
                                <th>Risk Assessment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="clientTableBody"></tbody>
                    </table>
                </div>
            </div>
            <footer>© 2026 smartwillsplanner.com</footer>
        </div>
    </div>
</div>
<!-- ===== Edit Modal ===== -->
<div id="editModal">
    <div class="modal-box">
        <div class="modal-head"><h2><i class="fas fa-user-edit"></i> Edit Client</h2><button class="close" onclick="closeEditModal()">&times;</button></div>
        <form id="editForm">
            <div class="fsection">
                <h3><i class="fas fa-info-circle"></i> General Information</h3>
                <div class="frow"><label>Full Name</label><input type="text" placeholder="Enter full name"></div>
                <div class="frow"><label>IC / Passport</label><input type="text" placeholder="Enter IC or passport number"></div>
                <div class="frow"><label>Mobile Number</label><input type="text" placeholder="e.g. 012-3456789"></div>
                <div class="frow"><label>Email Address</label><input type="email" placeholder="example@email.com"></div>
                <div class="frow"><label>Address</label><input type="text" placeholder="Enter full address"></div>
            </div>
            <div class="modal-btns">
                <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>
<!-- ===== Add Client Modal ===== -->
<div id="addModal">
    <div class="modal-box">
        <div class="modal-head">
            <h2><i class="fas fa-user-plus"></i> Add New Client</h2>
            <button class="close" onclick="closeAddModal()">&times;</button>
        </div>
        <form id="addForm">
            <div class="fsection">
                <div class="frow"><label>Client</label><input type="text" id="addClientName" placeholder="Enter client name"></div>
                <div class="frow"><label>Contact</label><input type="text" id="addContact" placeholder="Enter contact info"></div>
                <div class="frow"><label>Status</label>
                    <select id="addStatus">
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
            <div class="modal-btns">
                <button type="button" class="btn btn-cancel" onclick="closeAddModal()">Cancel</button>
                <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Save Client</button>
            </div>
        </form>
    </div>
</div>
<!-- ===== Risk Assessment Modal ===== -->
<div id="riskModal">
    <div class="modal-box">
        <div class="modal-head">
            <h2><i class="fas fa-clipboard-list"></i> Risk Assessment</h2>
            <button class="close" onclick="closeRiskModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="intro-text">
                <i class="fas fa-info-circle" style="color:#7a3f9e;margin-right:8px;"></i>
                For us to serve you better, kindly tick where appropriate when any of the situations apply to you.
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-user"></i> Personal & Family Circumstances</h3>
                <div class="ck-item"><input type="checkbox" id="risk_p1"><label for="risk_p1">I have no Will</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p2"><label for="risk_p2">My marital status has changed recently</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p3"><label for="risk_p3">My spouse is unfamiliar with business/financial matters</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p4"><label for="risk_p4">I am unsure who to appoint to manage my affairs after my passing</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p5"><label for="risk_p5">I have a newborn in the family</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p6"><label for="risk_p6">I have young children</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p7"><label for="risk_p7">I named my young children as beneficiaries to my insurance policies</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p8"><label for="risk_p8">I have a child with special needs</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p9"><label for="risk_p9">There is strong sibling rivalry among my children</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_p10"><label for="risk_p10">I have dependents, e.g. parents or parents-in-law whom I provide for</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-shield-alt"></i> Executor, Guardian &amp; Safekeeping Issues Circumstances</h3>
                <div class="ck-item"><input type="checkbox" id="risk_e1"><label for="risk_e1">I am no longer in touch with the appointed executor</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_e2"><label for="risk_e2">I am no longer in touch with the appointed guardian</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_e3"><label for="risk_e3">I need to pass my Will to someone for safekeeping</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-chart-pie"></i> Assets &amp; Financial Complexity</h3>
                <div class="ck-item"><input type="checkbox" id="risk_a1"><label for="risk_a1">I have assets in joint names and need to understand the legal implications of such holdings</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a2"><label for="risk_a2">I engage in active management of investments or trade in a portfolio of stocks</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a3"><label for="risk_a3">I have overseas assets</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a4"><label for="risk_a4">I do not have a schedule of assets that details my assets and liabilities</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_a5"><label for="risk_a5">My family would need continuity of funds while waiting for grant of probate</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-globe-asia"></i> Cross-Border Family &amp; Legal Issues</h3>
                <div class="ck-item"><input type="checkbox" id="risk_c1"><label for="risk_c1">I have family members who are permanent residents or citizens of another jurisdiction</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_c2"><label for="risk_c2">I have family members who are married to foreigners</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_c3"><label for="risk_c3">I am a Muslim or from a religious faith where my estate must be divided in a certain manner</label></div>
            </div>
            <div class="risk-section">
                <h3><i class="fas fa-briefcase"></i> Business &amp; Legacy Planning</h3>
                <div class="ck-item"><input type="checkbox" id="risk_b1"><label for="risk_b1">I wish to give a legacy to a charity but am not sure how this could be achieved</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b2"><label for="risk_b2">I work well with my business partners, but their heirs may be a problem</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b3"><label for="risk_b3">I am concerned that my business becomes fragmented if I divide it among my children</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b4"><label for="risk_b4">I am a businessman and am exposed to business risks and liabilities</label></div>
                <div class="ck-item"><input type="checkbox" id="risk_b5"><label for="risk_b5">I have properties and business interests that can provide for multi-generations or be maintained as long-term resources</label></div>
            </div>
            <div class="modal-btns">
                <button type="button" class="btn btn-cancel" onclick="closeRiskModal()">Close</button>
                <button type="button" class="btn btn-save-risk" onclick="saveRiskAssessment()"><i class="fas fa-save"></i> Go to Check result</button>
            </div>
        </div>
    </div>
</div>

<script>
// 数据与逻辑（保持不变）
const clients = [
    {id:1, name:'Zhang Wei', phone:'13812345678', status:'active', riskScore:8, updated:'2026-06-15'},
    {id:2, name:'Li Fang', phone:'13987654321', status:'done', riskScore:3, updated:'2026-06-10'},
    {id:3, name:'Wang Qiang', phone:'13755556666', status:'pending', riskScore:17, updated:'2026-06-12'}
];
let originalRiskModalHTML = '';
function gR(s){return s<=6?'Low':s<=15?'Moderate':'High'}
function gC(s){return s<=6?'low':s<=15?'moderate':'high'}
function gSL(s){return {active:'Active',done:'Completed',pending:'Pending'}[s]||s}
function gSC(s){return {active:'active',done:'done',pending:'pending'}[s]||'pending'}
function render(data){
    const t=document.getElementById('clientTableBody');
    if(!data.length){t.innerHTML='<tr><td colspan="7" style="text-align:center;padding:40px;color:#8aa4bc;">No clients found</td></tr>';return}
    t.innerHTML=data.map(c=>`
        <tr>
            <td><div class="client-name"><span class="avatar">${c.name.charAt(0)}</span>${c.name}</div></td>
            <td>${c.phone||'—'}</td>
            <td><span class="risk-badge ${gC(c.riskScore)}">${c.riskScore} · ${gR(c.riskScore)}</span></td>
            <td><span class="status-badge ${gSC(c.status)}">${gSL(c.status)}</span></td>
            <td>${c.updated||'—'}</td>
            <td><button class="btn-sm btn-risk-analyze" data-id="${c.id}"><i class="fas fa-chart-line"></i> Risk Analyze</button></td>
            <td><div class="action-cell">
                <button class="btn-sm btn-plan" data-id="${c.id}"><i class="fas fa-route"></i> Plan</button>
                <button class="btn-sm btn-edit" data-id="${c.id}"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn-sm btn-delete" data-id="${c.id}"><i class="fas fa-trash-alt"></i> Delete</button>
            </div></td>
        </tr>
    `).join('');
    document.querySelectorAll('[data-id]').forEach(b=>{
        b.onclick=function(e){
            e.stopPropagation();
            const id=this.dataset.id;
            const c=clients.find(x=>x.id==id);
            if(!c) return;
            if(this.classList.contains('btn-plan')){
                window.location.href = 'plan/myassets.php?id='+id;
            } else if(this.classList.contains('btn-edit')){
                openEditModal(id);
            } else if(this.classList.contains('btn-delete')){
                alert('Delete client: '+c.name+' (demo)');
            } else if(this.classList.contains('btn-risk-analyze')){
                openRiskModal(id);
            }
        };
    });
}
render(clients);
document.getElementById('searchInput').oninput=function(){
    const k=this.value.trim().toLowerCase();
    render(clients.filter(c=>c.name.toLowerCase().includes(k)||(c.phone&&c.phone.includes(k))));
};
document.getElementById('filterRisk').onchange=function(){
    const v=this.value;
    render(clients.filter(c=>v==='all'||gR(c.riskScore).toLowerCase()===v));
};
document.getElementById('filterStatus').onchange=function(){
    const v=this.value;
    render(clients.filter(c=>v==='all'||c.status===v));
};
document.getElementById('addClientBtn').onclick=function(){
    document.getElementById('addModal').style.display='block';
    document.body.style.overflow='hidden';
};
function closeAddModal(){
    document.getElementById('addModal').style.display='none';
    document.body.style.overflow='auto';
}
document.getElementById('addModal').onclick=function(e){if(e.target===this) closeAddModal();};
document.getElementById('addForm').onsubmit=function(e){
    e.preventDefault();
    const name = document.getElementById('addClientName').value.trim();
    const contact = document.getElementById('addContact').value.trim();
    const status = document.getElementById('addStatus').value;
    if(!name || !contact){
        alert('Please fill in both Client and Contact fields.');
        return;
    }
    alert('✅ New client added: ' + name + ' ('+contact+') - Status: '+status);
    closeAddModal();
};
function openEditModal(id){
    document.getElementById('editModal').style.display='block';
    document.body.style.overflow='hidden';
}
function closeEditModal(){
    document.getElementById('editModal').style.display='none';
    document.body.style.overflow='auto';
}
document.getElementById('editModal').onclick=function(e){if(e.target===this)closeEditModal();};
document.getElementById('editForm').onsubmit=function(e){e.preventDefault();alert('✅ Changes saved!');closeEditModal();};
document.addEventListener('DOMContentLoaded', function() {
    const modalBody = document.querySelector('#riskModal .modal-body');
    if (modalBody) {
        originalRiskModalHTML = modalBody.innerHTML;
    }
});
function openRiskModal(clientId){
    const modalBody = document.querySelector('#riskModal .modal-body');
    if (modalBody && originalRiskModalHTML) {
        modalBody.innerHTML = originalRiskModalHTML;
    }
    document.getElementById('riskModal').dataset.clientId = clientId;
    document.getElementById('riskModal').style.display='block';
    document.body.style.overflow='hidden';
}
function closeRiskModal(){
    document.getElementById('riskModal').style.display='none';
    document.body.style.overflow='auto';
}
document.getElementById('riskModal').onclick=function(e){
    if(e.target===this) closeRiskModal();
};
function saveRiskAssessment(){
    const clientId = document.getElementById('riskModal').dataset.clientId;
    if (!clientId) {
        alert('Client ID not found.');
        return;
    }
    const client = clients.find(c => c.id == clientId);
    if (!client) {
        alert('Client not found.');
        return;
    }
    const score = client.riskScore;
    let level, levelClass, descText;
    if (score <= 6) {
        level = 'LOW RISK';
        levelClass = 'low';
        descText = `This presumes that you already have an existing Will held in proper custody.<br>
        It is prudent to review and update your Will periodically with your Planner to ensure it continues to reflect your current wishes and circumstances.<br>
        We recommend doing this at least once every two to three years, or whenever there are significant changes in your life or financial situation.`;
    } else if (score <= 15) {
        level = 'MODERATE RISK';
        levelClass = 'moderate';
        descText = `It appears that your current Will, if you have one, is inadequate and does not comprehensively address your estate planning objectives.<br>
        This issue can be rectified through a consultation with your Planner, who can help identify and address any gaps by drafting a new Will or establishing Trusts.`;
    } else {
        level = 'RISKY TO HIGH RISK';
        levelClass = 'high';
        descText = `Your estate affairs may be fraught with delays and disputes among your family members.<br>
        The distribution outcome could be unsatisfactory for certain beneficiaries.<br>
        There are likely to be higher costs, leakages and legal expenses in sorting out the estate.<br>
        There is an urgent need to address your estate affairs, and you should meet with your Planner as soon as possible.`;
    }
    const modalBody = document.querySelector('#riskModal .modal-body');
    modalBody.innerHTML = `
        <div class="risk-result">
            <h3>WHAT'S YOUR SCORE AND WHERE DO YOU STAND?</h3>
            <div class="score-display">${score} points</div>
            <div class="risk-level ${levelClass}">${level}</div>
            <div class="desc">${descText}</div>
        </div>
        <div class="modal-btns" style="margin-top:20px;">
            <button type="button" class="btn btn-cancel" onclick="closeRiskModal()">Close</button>
        </div>
    `;
}
</script>
</body>
</html>