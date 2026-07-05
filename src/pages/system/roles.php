<?php


$pageTitle = 'User Role Maintenance';
$pageSubtitle = 'Create, update, and configure access permissions and security levels for system roles';
$breadcrumbs = [
    'System Management' => '',
    'Roles' => ''
];
$contentFile = __FILE__;


$roles = [
    ['id' => 1, 'name' => 'Administrator', 'desc' => 'Full access to all system directories, configurations, and reference tables.', 'users_count' => 1],
    ['id' => 2, 'name' => 'Secretary Desk Officer', 'desc' => 'Can manage residents, generate reports, approve documents, and edit lookups.', 'users_count' => 1],
    ['id' => 3, 'name' => 'Security Patrol Officer', 'desc' => 'Limited access. Can file and review blotter and case incident records.', 'users_count' => 1],
    ['id' => 4, 'name' => 'Read-Only Viewer', 'desc' => 'Can only view data. No creation, modification, or deletion rights.', 'users_count' => 1],
];


ob_start();
?>
<a href="<?= page_url('/system/roles/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Access Role
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Access Roles System</span>
        <span class="text-xs text-slate-400 font-mono">Total Roles: <?= count($roles) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-12 text-center">ID</th>
                <th class="w-56">Role Title Name</th>
                <th>Role Access Description</th>
                <th class="w-32 text-center">Active Users</th>
                <th class="w-28 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $r): ?>
                <tr>
                    <td class="text-center font-mono text-xs text-slate-500"><?= e($r['id']) ?></td>
                    <td class="font-medium text-slate-800 text-xs"><?= e($r['name']) ?></td>
                    <td class="text-xs text-slate-500"><?= e($r['desc']) ?></td>
                    <td class="text-center text-xs font-semibold text-slate-600"><?= e($r['users_count']) ?></td>
                    <td class="text-center">
                        <div class="inline-flex gap-1">
                            <a href="<?= page_url('/system/roles/edit?id=' . $r['id']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                            <?php if ($r['id'] > 1): ?>
                                <a href="#" onclick="confirm('Delete role?') ? alert('Deleted') : null; return false;" class="btn btn-secondary btn-xs text-danger-600">Delete</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
