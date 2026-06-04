<?php
/**
 * User Maintenance Page
 */

$pageTitle = 'User Maintenance';
$pageSubtitle = 'Create, update, and manage accounts and access logs for system users';
$breadcrumbs = [
    'System Management' => '',
    'Users' => ''
];
$contentFile = __FILE__;

// Mock user accounts list
$usersList = [
    ['id' => 1, 'username' => 'admin', 'name' => 'Juan Dela Cruz', 'role' => 'Administrator', 'email' => 'admin@juanbrgy.gov.ph', 'last_login' => '2026-06-03 21:05', 'status' => 'Active'],
    ['id' => 2, 'username' => 'sec_ramos', 'name' => 'Fidel Ramos', 'role' => 'Secretary Desk Officer', 'email' => 'sec.ramos@juanbrgy.gov.ph', 'last_login' => '2026-06-03 18:22', 'status' => 'Active'],
    ['id' => 3, 'username' => 'tanod_recto', 'name' => 'Claro Recto', 'role' => 'Security Patrol Officer', 'email' => 'recto@juanbrgy.gov.ph', 'last_login' => '2026-06-02 08:00', 'status' => 'Active'],
    ['id' => 4, 'username' => 'visitor1', 'name' => 'Mock Visitor Account', 'role' => 'Read-Only Viewer', 'email' => 'guest@gmail.com', 'last_login' => '2026-05-20 14:02', 'status' => 'Inactive'],
];

// Set header actions
ob_start();
?>
<a href="<?= page_url('/system/users/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New User Account
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
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Registered System Users</span>
        <span class="text-xs text-slate-400 font-mono">Total Users: <?= count($usersList) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-12 text-center">ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Assigned Access Role</th>
                <th>Email Address</th>
                <th>Last Login Log</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-32 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersList as $u): ?>
                <tr>
                    <td class="text-center font-mono text-xs text-slate-500"><?= e($u['id']) ?></td>
                    <td class="font-mono text-xs text-slate-700 font-semibold"><?= e($u['username']) ?></td>
                    <td class="font-medium text-slate-800 text-xs"><?= e($u['name']) ?></td>
                    <td>
                        <span class="badge badge-info"><?= e($u['role']) ?></span>
                    </td>
                    <td class="text-xs text-slate-500 font-mono"><?= e($u['email']) ?></td>
                    <td class="text-xs text-slate-500 font-mono"><?= e($u['last_login']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $u['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($u['status']) ?>
                        </span>
                    </td>
                    <td class="text-center font-medium">
                        <div class="inline-flex gap-1">
                            <a href="<?= page_url('/system/users/edit?id=' . $u['id']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                            <a href="#" onclick="confirm('Delete user?') ? alert('Deleted') : null; return false;" class="btn btn-secondary btn-xs text-danger-600">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
