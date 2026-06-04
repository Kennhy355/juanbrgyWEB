<?php
/**
 * Nationality Reference List Page
 */

$pageTitle = 'Nationality Master File';
$pageSubtitle = 'Manage registered nationality lookup classifications for resident records';
$breadcrumbs = [
    'Reference Tables' => '',
    'Nationality Master' => ''
];
$contentFile = __FILE__;

// Mock list
$nationalities = [
    ['code' => 'NAT-PH', 'name' => 'Filipino', 'notes' => 'Default local citizenship status.', 'status' => 'Active'],
    ['code' => 'NAT-US', 'name' => 'American', 'notes' => 'United States citizens.', 'status' => 'Active'],
    ['code' => 'NAT-JP', 'name' => 'Japanese', 'notes' => 'Japanese nationality entries.', 'status' => 'Active'],
    ['code' => 'NAT-CN', 'name' => 'Chinese', 'notes' => 'Chinese nationality records.', 'status' => 'Active'],
];

// Set header actions
ob_start();
?>
<a href="<?= page_url('/references/nationality/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Nationality
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Nationality Codes</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($nationalities) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Code</th>
                <th>Classification Name</th>
                <th>Remarks / Notes</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nationalities as $nat): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($nat['code']) ?></td>
                    <td class="font-semibold text-slate-800 text-xs"><?= e($nat['name']) ?></td>
                    <td class="text-xs text-slate-500"><?= e($nat['notes']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $nat['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($nat['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/nationality/edit?code=' . $nat['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
