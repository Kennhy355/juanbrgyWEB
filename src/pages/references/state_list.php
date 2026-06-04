<?php
/**
 * State / Province Reference List Page
 */

$pageTitle = 'State / Province Master File';
$pageSubtitle = 'Manage registered provinces and administrative states for address verification';
$breadcrumbs = [
    'Reference Tables' => '',
    'State / Province Master' => ''
];
$contentFile = __FILE__;

// Mock list
$provinces = [
    ['code' => 'PROV-METRO', 'name' => 'Metro Manila', 'region' => 'NCR', 'status' => 'Active'],
    ['code' => 'PROV-CEB', 'name' => 'Cebu', 'region' => 'Region VII', 'status' => 'Active'],
    ['code' => 'PROV-BUL', 'name' => 'Bulacan', 'region' => 'Region III', 'status' => 'Active'],
    ['code' => 'PROV-CAV', 'name' => 'Cavite', 'region' => 'Region IV-A', 'status' => 'Active'],
];

// Set header actions
ob_start();
?>
<a href="<?= page_url('/references/state/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Province
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Province / State Codes</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($provinces) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Code</th>
                <th>Province / State Name</th>
                <th>Region Association</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($provinces as $prov): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($prov['code']) ?></td>
                    <td class="font-semibold text-slate-800 text-xs"><?= e($prov['name']) ?></td>
                    <td class="text-xs"><?= e($prov['region']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $prov['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($prov['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/state/edit?code=' . $prov['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
