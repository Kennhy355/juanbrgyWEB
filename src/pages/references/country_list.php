<?php


$pageTitle = 'Country Master File';
$pageSubtitle = 'Manage country registries for foreign nationalities and demographic logs';
$breadcrumbs = [
    'Reference Tables' => '',
    'Country Master' => ''
];
$contentFile = __FILE__;


$countries = [
    ['code' => 'CTR-PH', 'name' => 'Philippines', 'iso' => 'PH / PHL', 'status' => 'Active'],
    ['code' => 'CTR-US', 'name' => 'United States of America', 'iso' => 'US / USA', 'status' => 'Active'],
    ['code' => 'CTR-JP', 'name' => 'Japan', 'iso' => 'JP / JPN', 'status' => 'Active'],
    ['code' => 'CTR-CN', 'name' => 'China', 'iso' => 'CN / CHN', 'status' => 'Active'],
];


ob_start();
?>
<a href="<?= page_url('/references/country/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Country
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Country Codes</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($countries) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Code</th>
                <th>Country Official Name</th>
                <th>ISO Alpha Codes</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countries as $ctr): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($ctr['code']) ?></td>
                    <td class="font-semibold text-slate-800 text-xs"><?= e($ctr['name']) ?></td>
                    <td class="text-xs font-mono text-slate-600"><?= e($ctr['iso']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $ctr['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($ctr['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/country/edit?code=' . $ctr['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
