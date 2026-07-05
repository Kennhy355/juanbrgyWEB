<?php


$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Communication Channel' : 'Configure Communication Channel';
$pageSubtitle = $isEdit ? 'Modify routing protocols for communication channel: ' . e($code) : 'Define new automated communication delivery rules and gateways';
$breadcrumbs = [
    'Reference Tables' => '',
    'Communication Master' => '/references/communication',
    'Set-up' => ''
];
$contentFile = __FILE__;


$channel = [
    'code' => '',
    'name' => '',
    'gateway' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $channel = [
        'code' => $code,
        'name' => 'Mobile / SMS Text',
        'gateway' => 'SMS Gateway V2',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Communication channel option saved successfully.';
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

<form action="<?= page_url($isEdit ? '/references/communication/edit?code=' . e($code) : '/references/communication/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Communication Channel Details</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Channel Reference Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($channel['code']) ?>" placeholder="e.g. COM-SMS" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Channel Label Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($channel['name']) ?>" placeholder="e.g. Mobile / SMS Text">
    </div>

    <div class="form-group">
        <label for="gateway" class="form-label form-label-required">Delivery Gateway / Protocol</label>
        <input type="text" id="gateway" name="gateway" class="form-input font-mono" required value="<?= e($channel['gateway']) ?>" placeholder="e.g. SMS Gateway V2">
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $channel['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $channel['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Channel</button>
        <a href="<?= page_url('/references/communication') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
