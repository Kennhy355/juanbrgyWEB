<?php
/**
 * Customized Report Menu List Page
 */

$pageTitle = 'Customized Report Menu List';
$pageSubtitle = 'Create, update, and generate custom-made report query templates';
$breadcrumbs = [
    'Reports & Queries' => '',
    'Custom Reports' => ''
];
$contentFile = __FILE__;

// Mock custom templates
$customReports = [
    ['id' => 1, 'name' => 'Active Male Voters in Purok 1', 'desc' => 'Filtered query showing male residents aged 18+ in Purok 1.', 'created_by' => 'Admin Jose', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Female Senior Citizens Contact List', 'desc' => 'Retrieves phone numbers of women aged 60+ for healthcare reminders.', 'created_by' => 'Sec. Ramos', 'status' => 'Active'],
    ['id' => 3, 'name' => 'Incident Reports - Purok 3 (Closed)', 'desc' => 'Logs closed incidents/blotter reports specifically from Zone 3.', 'created_by' => 'Tanod Officer', 'status' => 'Inactive'],
];

// Set header actions
ob_start();
?>
<a href="<?= page_url('/reports/custom/create') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Create Custom Layout
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Custom Templates Menu</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($customReports) ?> configured</span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-16 text-center">ID</th>
                <th class="w-64">Template Name</th>
                <th>Description</th>
                <th class="w-32">Created By</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-48 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customReports as $rep): ?>
                <tr>
                    <td class="text-center font-mono text-xs text-slate-500"><?= e($rep['id']) ?></td>
                    <td class="font-semibold text-slate-700"><?= e($rep['name']) ?></td>
                    <td class="text-slate-500 text-xs"><?= e($rep['desc']) ?></td>
                    <td class="text-xs text-slate-600"><?= e($rep['created_by']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $rep['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($rep['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="inline-flex gap-1">
                            <a href="#" onclick="alert('Running Query: <?= e($rep['name']) ?>'); return false;" class="btn btn-secondary btn-xs">Generate</a>
                            <a href="<?= page_url('/reports/custom/edit?id=' . $rep['id']) ?>" class="btn btn-secondary btn-xs text-accent-700">Edit</a>
                            <a href="#" onclick="confirm('Delete template?') ? alert('Deleted') : null; return false;" class="btn btn-secondary btn-xs text-danger-600">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
