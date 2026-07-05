<?php


$pageTitle = 'Religion Master File';
$pageSubtitle = 'Manage registered religious affiliation lookup values for resident profiles';
$breadcrumbs = [
    'Reference Tables' => '',
    'Religion Master' => ''
];
$contentFile = __FILE__;


$religions = [
    ['code' => 'REL-RC', 'name' => 'Roman Catholic', 'status' => 'Active'],
    ['code' => 'REL-INC', 'name' => 'Iglesia ni Cristo', 'status' => 'Active'],
    ['code' => 'REL-ISL', 'name' => 'Islam', 'status' => 'Active'],
    ['code' => 'REL-SDA', 'name' => 'Seventh-day Adventist', 'status' => 'Active'],
    ['code' => 'REL-EVG', 'name' => 'Evangelical Christian', 'status' => 'Active'],
];


ob_start();
?>
<a href="<?= page_url('/references/religion/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Religion
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Religion Option Values</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($religions) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Code</th>
                <th>Affiliation Label Name</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($religions as $rel): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($rel['code']) ?></td>
                    <td class="font-semibold text-slate-800 text-xs"><?= e($rel['name']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $rel['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($rel['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/religion/edit?code=' . $rel['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
