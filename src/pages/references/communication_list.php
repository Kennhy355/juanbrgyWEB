<?php


$pageTitle = 'Ways of Communication Master';
$pageSubtitle = 'Manage communication channels (SMS, Email, Written) used for notification delivery';
$breadcrumbs = [
    'Reference Tables' => '',
    'Communication Master' => ''
];
$contentFile = __FILE__;


$channels = [
    ['code' => 'COM-SMS', 'name' => 'Mobile / SMS Text', 'gateway' => 'SMS Gateway V2', 'status' => 'Active'],
    ['code' => 'COM-MAIL', 'name' => 'Email Address Notification', 'gateway' => 'SMTP Mail Relay Server', 'status' => 'Active'],
    ['code' => 'COM-LET', 'name' => 'Letter / Printed Courier', 'gateway' => 'Manual dispatch', 'status' => 'Active'],
    ['code' => 'COM-TEL', 'name' => 'Landline / Phone Call', 'gateway' => 'Voice Operator', 'status' => 'Inactive'],
];


ob_start();
?>
<a href="<?= page_url('/references/communication/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Channel
</a>
<?php
$headerActions = ob_get_clean();

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="data-table-wrapper">
    <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Communication Channel Options</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($channels) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Code</th>
                <th>Channel Name</th>
                <th>Delivery Gateway / Protocol</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($channels as $chan): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($chan['code']) ?></td>
                    <td class="font-semibold text-slate-800 text-xs"><?= e($chan['name']) ?></td>
                    <td class="text-xs text-slate-600 font-mono"><?= e($chan['gateway']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $chan['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($chan['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/communication/edit?code=' . $chan['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
