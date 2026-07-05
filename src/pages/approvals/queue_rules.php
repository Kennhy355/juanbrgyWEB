<?php


$pageTitle = 'Admin Request Queue Rules';
$pageSubtitle = 'Configure authorization workflows and routing protocols for official barangay documents';
$breadcrumbs = [
    'Approvals' => '',
    'Queue Rules' => ''
];
$contentFile = __FILE__;


$rules = [
    ['id' => 'RUL-01', 'name' => 'Barangay Clearance Auto-Route', 'entity' => 'Clearance Request', 'role' => 'Barangay Captain / Secretary', 'order' => 1, 'status' => 'Active'],
    ['id' => 'RUL-02', 'name' => 'Certificate of Indigency Validation', 'entity' => 'Indigency Request', 'role' => 'Social Worker / Secretary', 'order' => 1, 'status' => 'Active'],
    ['id' => 'RUL-03', 'name' => 'Peace & Order Dispute Clearance', 'entity' => 'Blotter Release', 'role' => 'Lupon / Captain', 'order' => 2, 'status' => 'Active'],
    ['id' => 'RUL-04', 'name' => 'Business Permit Endorsement', 'entity' => 'Business Clearance', 'role' => 'Barangay Treasurer', 'order' => 1, 'status' => 'Inactive'],
];

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Approval routing rule settings updated successfully.';
}

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<?php if ($successMsg): ?>
    <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span><?= e($successMsg) ?></span>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    
    <div class="bg-white border border-slate-200 rounded-lg p-5">
        <h3 class="text-sm font-semibold text-slate-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Set-up Approval Rule</h3>
        <form action="<?= page_url('/approvals/rules') ?>" method="POST" class="space-y-4">
            <div class="form-group">
                <label for="rule_name" class="form-label form-label-required">Rule Name / Description</label>
                <input type="text" id="rule_name" name="rule_name" class="form-input text-xs" required placeholder="e.g. Clearance Auto-Route" value="Barangay Clearance Auto-Route">
            </div>

            <div class="form-group">
                <label for="entity" class="form-label form-label-required">Document / Request Type</label>
                <select id="entity" name="entity" class="form-select text-xs" required>
                    <option value="Clearance Request">Barangay Clearance Request</option>
                    <option value="Indigency Request">Certificate of Indigency</option>
                    <option value="Blotter Release">Blotter Release Request</option>
                    <option value="Business Clearance">Business Clearance</option>
                </select>
            </div>

            <div class="form-group">
                <label for="role" class="form-label form-label-required">Approving User Role</label>
                <select id="role" name="role" class="form-select text-xs" required>
                    <option value="Barangay Captain / Secretary">Barangay Captain / Secretary</option>
                    <option value="Social Worker / Secretary">Social Worker / Secretary</option>
                    <option value="Lupon / Captain">Lupon / Captain</option>
                    <option value="Barangay Treasurer">Barangay Treasurer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="order" class="form-label form-label-required">Workflow Sequence Order</label>
                <input type="number" id="order" name="order" class="form-input text-xs" required value="1" min="1">
            </div>

            <div class="form-group">
                <label for="status" class="form-label form-label-required">Rule Status</label>
                <select id="status" name="status" class="form-select text-xs" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="pt-2 flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Save Rule</button>
                <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
            </div>
        </form>
    </div>

    
    <div class="lg:col-span-2 space-y-6">
        <div class="data-table-wrapper">
            <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Configured Routing Rules</span>
                <span class="text-xs text-slate-400 font-mono">Total: <?= count($rules) ?></span>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-20">Rule ID</th>
                        <th>Rule Name</th>
                        <th>Request Type</th>
                        <th>Required Signee</th>
                        <th class="w-16 text-center">Step</th>
                        <th class="w-20 text-center">Status</th>
                        <th class="w-24 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rules as $rul): ?>
                        <tr>
                            <td class="font-mono text-xs text-slate-500"><?= e($rul['id']) ?></td>
                            <td class="font-medium text-slate-800 text-xs"><?= e($rul['name']) ?></td>
                            <td class="text-xs"><?= e($rul['entity']) ?></td>
                            <td class="text-xs text-slate-600"><?= e($rul['role']) ?></td>
                            <td class="text-center font-semibold text-xs"><?= e($rul['order']) ?></td>
                            <td class="text-center">
                                <span class="badge <?= $rul['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                                    <?= e($rul['status']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="inline-flex gap-1">
                                    <a href="#" onclick="alert('Rule selected for edit'); return false;" class="btn btn-secondary btn-xs">Edit</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        
        <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
            <h4 class="text-xs font-semibold text-slate-700 uppercase tracking-wide mb-2 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gov-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                Active Workflow Proof Summary
            </h4>
            <p class="text-xs text-slate-500 leading-relaxed">
                Rules govern the automatic authorization queue routing path. Changes to active rules will immediately recalculate pending actions inside the <strong>Admin Request Authorization Page</strong> queue.
            </p>
        </div>
    </div>

</div>
