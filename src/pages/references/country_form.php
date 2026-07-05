<?php


$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Country Record' : 'Configure Country Record';
$pageSubtitle = $isEdit ? 'Modify information settings for country code: ' . e($code) : 'Define new country codes and ISO alpha mappings';
$breadcrumbs = [
    'Reference Tables' => '',
    'Country Master' => '/references/country',
    'Set-up' => ''
];
$contentFile = __FILE__;


$country = [
    'code' => '',
    'name' => '',
    'iso' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $country = [
        'code' => $code,
        'name' => 'Philippines',
        'iso' => 'PH / PHL',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Country registry record saved successfully.';
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

<form action="<?= page_url($isEdit ? '/references/country/edit?code=' . e($code) : '/references/country/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Country Information</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Country Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($country['code']) ?>" placeholder="e.g. CTR-PH" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Country Official Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($country['name']) ?>" placeholder="e.g. Philippines">
    </div>

    <div class="form-group">
        <label for="iso" class="form-label form-label-required">ISO Alpha Reference (2-letter / 3-letter)</label>
        <input type="text" id="iso" name="iso" class="form-input font-mono" required value="<?= e($country['iso']) ?>" placeholder="e.g. PH / PHL">
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $country['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $country['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Country</button>
        <a href="<?= page_url('/references/country') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
