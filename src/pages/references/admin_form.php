<?php
/**
 * Admin Master File Form Page
 */

$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Admin Record' : 'Create Admin Record';
$pageSubtitle = $isEdit ? 'Modify information settings for Admin code: ' . e($code) : 'Define profile details and department assignments for new administrative personnel';
$breadcrumbs = [
    'Reference Tables' => '',
    'Admin Master' => '/references/admin',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock admin data
$admin = [
    'code' => '',
    'name' => '',
    'role' => 'Desk Clerk',
    'dept' => '',
    'email' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $admin = [
        'code' => $code,
        'name' => 'Jose Rizal',
        'role' => 'Super Administrator',
        'dept' => 'Office of the Captain',
        'email' => 'jose.rizal@juanbrgy.gov.ph',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Admin master file updated successfully.';
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

<form action="<?= page_url($isEdit ? '/references/admin/edit?code=' . e($code) : '/references/admin/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Admin Account Details</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Admin Account Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($admin['code']) ?>" placeholder="e.g. ADM-01" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Admin Personnel Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($admin['name']) ?>" placeholder="e.g. Jose Rizal">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="role" class="form-label form-label-required">Administrative Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="Super Administrator" <?= $admin['role'] === 'Super Administrator' ? 'selected' : '' ?>>Super Administrator</option>
                <option value="Officer-in-Charge" <?= $admin['role'] === 'Officer-in-Charge' ? 'selected' : '' ?>>Officer-in-Charge</option>
                <option value="Desk Clerk" <?= $admin['role'] === 'Desk Clerk' ? 'selected' : '' ?>>Desk Clerk</option>
                <option value="Support Staff" <?= $admin['role'] === 'Support Staff' ? 'selected' : '' ?>>Support Staff</option>
            </select>
        </div>
        <div class="form-group">
            <label for="dept" class="form-label form-label-required">Assigned Department Desk</label>
            <input type="text" id="dept" name="dept" class="form-input" required value="<?= e($admin['dept']) ?>" placeholder="e.g. Office of the Captain">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="email" class="form-label form-label-required">Government Email</label>
            <input type="email" id="email" name="email" class="form-input font-mono" required value="<?= e($admin['email']) ?>" placeholder="e.g. employee@juanbrgy.gov.ph">
        </div>
        <div class="form-group">
            <label for="status" class="form-label form-label-required">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="Active" <?= $admin['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $admin['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
    </div>

    <!-- Actions -->
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Admin Info</button>
        <a href="<?= page_url('/references/admin') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
