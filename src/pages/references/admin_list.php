<?php


$pageTitle = 'Admin Master File';
$pageSubtitle = 'Manage system administrators, access credentials, and department assignments';
$breadcrumbs = [
    'Reference Tables' => '',
    'Admin Master' => ''
];
$contentFile = __FILE__;


$admins = [
    ['code' => 'ADM-01', 'name' => 'Jose Rizal', 'role' => 'Super Administrator', 'dept' => 'Office of the Captain', 'email' => 'jose.rizal@juanbrgy.gov.ph', 'status' => 'Active'],
    ['code' => 'ADM-02', 'name' => 'Andres Bonifacio', 'role' => 'Officer-in-Charge', 'dept' => 'Peace & Order Desk', 'email' => 'andres.b@juanbrgy.gov.ph', 'status' => 'Active'],
    ['code' => 'ADM-03', 'name' => 'Apolinario Mabini', 'role' => 'Desk Clerk', 'dept' => 'Social Welfare Dept', 'email' => 'apolinario.m@juanbrgy.gov.ph', 'status' => 'Active'],
    ['code' => 'ADM-04', 'name' => 'Emilio Jacinto', 'role' => 'Support Staff', 'dept' => 'SK Youth Council Desk', 'email' => 'emilio.j@juanbrgy.gov.ph', 'status' => 'Inactive'],
];


ob_start();
?>
<a href="<?= page_url('/references/admin/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Admin Record
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
        <div class="search-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input text-xs" placeholder="Search admin name..." oninput="alert('Typing filter...');">
        </div>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($admins) ?> records</span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-28">Admin Code</th>
                <th>Admin Name</th>
                <th>Assigned Role</th>
                <th>Department Desk</th>
                <th>Email Address</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $adm): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($adm['code']) ?></td>
                    <td class="font-medium text-slate-800 text-xs"><?= e($adm['name']) ?></td>
                    <td class="text-xs"><?= e($adm['role']) ?></td>
                    <td class="text-xs text-slate-600"><?= e($adm['dept']) ?></td>
                    <td class="text-xs text-slate-500 font-mono"><?= e($adm['email']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $adm['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($adm['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/admin/edit?code=' . $adm['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
