<?php
/**
 * State / Province Reference Form Page
 */

$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Province Record' : 'Configure Province Record';
$pageSubtitle = $isEdit ? 'Modify information settings for province code: ' . e($code) : 'Define new state or province administrative boundary reference tag';
$breadcrumbs = [
    'Reference Tables' => '',
    'State / Province Master' => '/references/state',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock configuration settings
$province = [
    'code' => '',
    'name' => '',
    'region' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $province = [
        'code' => $code,
        'name' => 'Metro Manila',
        'region' => 'NCR',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Province record saved successfully.';
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

<form action="<?= page_url($isEdit ? '/references/state/edit?code=' . e($code) : '/references/state/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Province / State Information</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Province Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($province['code']) ?>" placeholder="e.g. PROV-METRO" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Province / State Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($province['name']) ?>" placeholder="e.g. Metro Manila">
    </div>

    <div class="form-group">
        <label for="region" class="form-label form-label-required">Region Association Tag</label>
        <input type="text" id="region" name="region" class="form-input" required value="<?= e($province['region']) ?>" placeholder="e.g. NCR or Region IV-A">
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $province['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $province['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <!-- Actions -->
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Province</button>
        <a href="<?= page_url('/references/state') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
