<?php


$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Municipality Record' : 'Configure Municipality Record';
$pageSubtitle = $isEdit ? 'Modify information settings for municipality code: ' . e($code) : 'Define new city/municipality name and ZIP reference for registries';
$breadcrumbs = [
    'Reference Tables' => '',
    'Municipality Master' => '/references/municipality',
    'Set-up' => ''
];
$contentFile = __FILE__;


$municipality = [
    'code' => '',
    'name' => '',
    'province_id' => '1',
    'zip' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $municipality = [
        'code' => $code,
        'name' => 'Manila',
        'province_id' => '1',
        'zip' => '1000',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Municipality record saved successfully.';
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

<form action="<?= page_url($isEdit ? '/references/municipality/edit?code=' . e($code) : '/references/municipality/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Municipality / City Information</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Municipality Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($municipality['code']) ?>" placeholder="e.g. MUN-MNL" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">City / Municipality Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($municipality['name']) ?>" placeholder="e.g. Manila">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="province_id" class="form-label form-label-required">State / Province (Lookup)</label>
            <select id="province_id" name="province_id" class="form-select" required>
                <option value="1" selected>Metro Manila</option>
                <option value="2">Cebu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="zip" class="form-label form-label-required">ZIP Postal Code</label>
            <input type="text" id="zip" name="zip" class="form-input font-mono" required value="<?= e($municipality['zip']) ?>" placeholder="e.g. 1000">
        </div>
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $municipality['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $municipality['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Municipality</button>
        <a href="<?= page_url('/references/municipality') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
