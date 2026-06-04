<?php
/**
 * Religion Reference Form Page
 */

$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Religion Option' : 'Configure Religion Option';
$pageSubtitle = $isEdit ? 'Modify information settings for religion code: ' . e($code) : 'Define new religious affiliation lookup tag';
$breadcrumbs = [
    'Reference Tables' => '',
    'Religion Master' => '/references/religion',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock configuration settings
$religion = [
    'code' => '',
    'name' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $religion = [
        'code' => $code,
        'name' => 'Roman Catholic',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Religion lookup records saved successfully.';
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

<form action="<?= page_url($isEdit ? '/references/religion/edit?code=' . e($code) : '/references/religion/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Religion Option Details</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Option Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($religion['code']) ?>" placeholder="e.g. REL-RC" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Affiliation Label Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($religion['name']) ?>" placeholder="e.g. Roman Catholic">
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $religion['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $religion['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <!-- Actions -->
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Option</button>
        <a href="<?= page_url('/references/religion') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
