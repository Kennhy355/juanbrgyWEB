<?php
/**
 * Nationality Reference Form Page
 */

$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Nationality Record' : 'Configure Nationality Record';
$pageSubtitle = $isEdit ? 'Modify information settings for nationality code: ' . e($code) : 'Define new nationality lookup tags for user registries';
$breadcrumbs = [
    'Reference Tables' => '',
    'Nationality Master' => '/references/nationality',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock configuration settings
$nationality = [
    'code' => '',
    'name' => '',
    'notes' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $nationality = [
        'code' => $code,
        'name' => 'Filipino',
        'notes' => 'Default local citizenship status.',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Nationality lookup record updated successfully.';
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

<form action="<?= page_url($isEdit ? '/references/nationality/edit?code=' . e($code) : '/references/nationality/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Nationality Information</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Nationality Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($nationality['code']) ?>" placeholder="e.g. NAT-PH" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Nationality Classification Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($nationality['name']) ?>" placeholder="e.g. Filipino">
    </div>

    <div class="form-group">
        <label for="notes" class="form-label">Notes / Description</label>
        <input type="text" id="notes" name="notes" class="form-input" value="<?= e($nationality['notes']) ?>" placeholder="Describe usage notes...">
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $nationality['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $nationality['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <!-- Actions -->
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Nationality</button>
        <a href="<?= page_url('/references/nationality') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
