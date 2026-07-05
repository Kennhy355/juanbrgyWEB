<?php


$pageTitle = 'Municipality Master File';
$pageSubtitle = 'Manage registered cities and municipalities for residential address lookup';
$breadcrumbs = [
    'Reference Tables' => '',
    'Municipality Master' => ''
];
$contentFile = __FILE__;


$municipalities = [
    ['code' => 'MUN-MNL', 'name' => 'Manila', 'province' => 'Metro Manila', 'zip' => '1000', 'status' => 'Active'],
    ['code' => 'MUN-QC', 'name' => 'Quezon City', 'province' => 'Metro Manila', 'zip' => '1100', 'status' => 'Active'],
    ['code' => 'MUN-CEB', 'name' => 'Cebu City', 'province' => 'Cebu', 'zip' => '6000', 'status' => 'Active'],
    ['code' => 'MUN-DVO', 'name' => 'Davao City', 'province' => 'Davao del Sur', 'zip' => '8000', 'status' => 'Active'],
];


ob_start();
?>
<a href="<?= page_url('/references/municipality/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Municipality
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Municipality / City Entries</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($municipalities) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Code</th>
                <th>Municipality / City Name</th>
                <th>State / Province Group</th>
                <th class="w-36">ZIP Code</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($municipalities as $mun): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($mun['code']) ?></td>
                    <td class="font-semibold text-slate-800 text-xs"><?= e($mun['name']) ?></td>
                    <td class="text-xs"><?= e($mun['province']) ?></td>
                    <td class="font-mono text-xs text-slate-500"><?= e($mun['zip']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $mun['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($mun['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/municipality/edit?code=' . $mun['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
