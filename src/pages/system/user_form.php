<?php
/**
 * User Maintenance Form Page
 */

$id = trim($_GET['id'] ?? '');
$isEdit = $id !== '';

$pageTitle = $isEdit ? 'Set-up User Account' : 'Configure User Account';
$pageSubtitle = $isEdit ? 'Modify information settings for User ID: ' . e($id) : 'Define new username, login credentials, and assign system access permissions';
$breadcrumbs = [
    'System Management' => '',
    'Users' => '/system/users',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock configuration settings
$userAcc = [
    'username' => '',
    'name' => '',
    'email' => '',
    'role' => 'Secretary Desk Officer',
    'status' => 'Active'
];

if ($isEdit) {
    $userAcc = [
        'username' => 'sec_ramos',
        'name' => 'Fidel Ramos',
        'email' => 'sec.ramos@juanbrgy.gov.ph',
        'role' => 'Secretary Desk Officer',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'User profile settings saved successfully.';
}

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<?php if ($successMsg): ?>
    <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span><?= e($successMsg) ?></span>
    </div>
<?php endif; ?>

<form action="<?= page_url($isEdit ? '/system/users/edit?id=' . e($id) : '/system/users/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">User Profile Details</div>
    
    <div class="form-group">
        <label for="username" class="form-label form-label-required">Account Username</label>
        <input type="text" id="username" name="username" class="form-input font-mono" required value="<?= e($userAcc['username']) ?>" placeholder="e.g. sec_ramos" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Personnel Full Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($userAcc['name']) ?>" placeholder="e.g. Fidel Ramos">
    </div>

    <div class="form-group">
        <label for="email" class="form-label form-label-required">Contact Email Address</label>
        <input type="email" id="email" name="email" class="form-input font-mono" required value="<?= e($userAcc['email']) ?>" placeholder="e.g. sec.ramos@juanbrgy.gov.ph">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="role" class="form-label form-label-required">Assign System Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="Administrator" <?= $userAcc['role'] === 'Administrator' ? 'selected' : '' ?>>Administrator</option>
                <option value="Secretary Desk Officer" <?= $userAcc['role'] === 'Secretary Desk Officer' ? 'selected' : '' ?>>Secretary Desk Officer</option>
                <option value="Security Patrol Officer" <?= $userAcc['role'] === 'Security Patrol Officer' ? 'selected' : '' ?>>Security Patrol Officer</option>
                <option value="Read-Only Viewer" <?= $userAcc['role'] === 'Read-Only Viewer' ? 'selected' : '' ?>>Read-Only Viewer</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status" class="form-label form-label-required">Account Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="Active" <?= $userAcc['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $userAcc['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
    </div>

    <!-- Password change warning warning -->
    <div class="form-group bg-slate-50 border border-slate-200 rounded p-3 text-xs text-slate-500">
        <?= $isEdit ? 'Leave password fields blank to preserve the current administrative login credential credentials.' : 'New accounts default to username as the starter temporary password.' ?>
    </div>

    <!-- Actions -->
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save User settings</button>
        <a href="<?= page_url('/system/users') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
