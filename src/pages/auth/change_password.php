<?php
/**
 * Change Password Page
 */

$pageTitle = 'Change Password';
$pageSubtitle = 'Update your security credentials';
$breadcrumbs = [
    'System' => '',
    'Change Password' => ''
];
$contentFile = __FILE__;

// Mock message handling
$successMsg = '';
$errorMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($current !== 'admin') {
        $errorMsg = 'Current password is incorrect.';
    } elseif ($new !== $confirm) {
        $errorMsg = 'New password and confirmation do not match.';
    } elseif (strlen($new) < 5) {
        $errorMsg = 'Password must be at least 5 characters long.';
    } else {
        $successMsg = 'Password changed successfully.';
    }
}

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="max-w-md bg-white border border-slate-200 rounded-lg p-6">
    <?php if ($successMsg): ?>
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span><?= e($successMsg) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($errorMsg): ?>
        <div class="alert alert-danger">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span><?= e($errorMsg) ?></span>
        </div>
    <?php endif; ?>

    <form action="<?= page_url('/auth/change-password') ?>" method="POST" class="space-y-4">
        <div class="form-group">
            <label for="current_password" class="form-label form-label-required">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-input" required placeholder="Enter current password">
        </div>

        <div class="form-group">
            <label for="new_password" class="form-label form-label-required">New Password</label>
            <input type="password" id="new_password" name="new_password" class="form-input" required placeholder="Enter new password (min. 5 chars)">
        </div>

        <div class="form-group">
            <label for="confirm_password" class="form-label form-label-required">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-input" required placeholder="Re-type new password">
        </div>

        <div class="form-actions pt-2">
            <button type="submit" class="btn btn-primary">Update Password</button>
            <a href="<?= page_url('/') ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
