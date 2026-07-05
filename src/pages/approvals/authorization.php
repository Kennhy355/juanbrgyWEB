<?php


$pageTitle = 'Admin Request Authorization';
$pageSubtitle = 'Review, approve, hold, or reject pending document requests from residents';
$breadcrumbs = [
    'Approvals' => '',
    'Queue' => ''
];
$contentFile = __FILE__;


$queue = [
    ['id' => 'REQ-2026-009', 'resident' => 'Maria Santos', 'type' => 'Barangay Clearance', 'date' => '2026-06-03 10:14', 'purpose' => 'Employment requirement', 'status' => 'Pending'],
    ['id' => 'REQ-2026-008', 'resident' => 'Juan Dela Cruz', 'type' => 'Certificate of Indigency', 'date' => '2026-06-03 09:30', 'purpose' => 'Medical financial aid', 'status' => 'Pending'],
    ['id' => 'REQ-2026-007', 'resident' => 'Pedro Penduko', 'type' => 'Barangay Clearance', 'date' => '2026-06-02 16:45', 'purpose' => 'Business Permit Application', 'status' => 'Pending'],
    ['id' => 'REQ-2026-006', 'resident' => 'Gloria Macapagal', 'type' => 'Cedula', 'date' => '2026-06-02 11:20', 'purpose' => 'Government Identification Proof', 'status' => 'On Hold'],
    ['id' => 'REQ-2026-005', 'resident' => 'Ferdinand Marcos', 'type' => 'Barangay Clearance', 'date' => '2026-06-01 14:02', 'purpose' => 'Travel abroad clearances', 'status' => 'Approved'],
];

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="data-table-wrapper">
    <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Pending Approvals Queue</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($queue) ?> records</span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-32">Request ID</th>
                <th>Requestor Name</th>
                <th class="w-56">Document / Request Type</th>
                <th>Requested Date</th>
                <th>Purpose / Description</th>
                <th class="w-28 text-center">Status</th>
                <th class="w-56 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($queue as $req): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($req['id']) ?></td>
                    <td class="font-medium text-slate-800"><?= e($req['resident']) ?></td>
                    <td><?= e($req['type']) ?></td>
                    <td class="text-xs text-slate-500"><?= e($req['date']) ?></td>
                    <td class="text-xs text-slate-600 max-w-xs truncate" title="<?= e($req['purpose']) ?>"><?= e($req['purpose']) ?></td>
                    <td class="text-center">
                        <?php 
                            $badge = 'badge-pending';
                            if ($req['status'] === 'On Hold') $badge = 'badge-inactive';
                            if ($req['status'] === 'Approved') $badge = 'badge-active';
                        ?>
                        <span class="badge <?= $badge ?>"><?= e($req['status']) ?></span>
                    </td>
                    <td class="text-center">
                        <?php if ($req['status'] === 'Pending' || $req['status'] === 'On Hold'): ?>
                            <div class="inline-flex gap-1">
                                <button onclick="alert('Request <?= e($req['id']) ?> Approved successfully. Triggering notification alert to <?= e($req['resident']) ?>...'); window.location.reload();" class="btn btn-success btn-xs">Approve</button>
                                <button onclick="alert('Request <?= e($req['id']) ?> placed on Hold.'); window.location.reload();" class="btn btn-secondary btn-xs">Hold</button>
                                <button onclick="const reason = prompt('Reason for rejection:'); if(reason) { alert('Request <?= e($req['id']) ?> Rejected. Notification alert sent.'); window.location.reload(); }" class="btn btn-danger btn-xs">Reject</button>
                            </div>
                        <?php else: ?>
                            <span class="text-xs text-slate-400 font-medium">Completed</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="mt-6 bg-slate-50 border border-slate-200 rounded-lg p-5">
    <h3 class="text-xs font-semibold text-slate-700 uppercase tracking-wide mb-3">Notification Alert Trigger Settings</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-slate-600">
        <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="checkbox" class="form-checkbox" checked>
            <span>Send automated SMS text message immediately upon approval/rejection</span>
        </label>
        <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="checkbox" class="form-checkbox" checked>
            <span>Send automated email notification when document is ready for collection</span>
        </label>
    </div>
</div>
