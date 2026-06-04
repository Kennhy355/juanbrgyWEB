<?php
/**
 * Cases / Type of Incident Reference Form Page
 */

$code = trim($_GET['code'] ?? '');
$isEdit = $code !== '';

$pageTitle = $isEdit ? 'Set-up Incident Case Type' : 'Configure Incident Case Type';
$pageSubtitle = $isEdit ? 'Modify rules and assignments for case code: ' . e($code) : 'Define new classification, default severity and desk officer assignment for incident reports';
$breadcrumbs = [
    'Reference Tables' => '',
    'Cases / Incidents Master' => '/references/cases',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock configuration settings
$incident = [
    'code' => '',
    'name' => '',
    'severity' => 'Low',
    'dept' => '',
    'status' => 'Active'
];

if ($isEdit) {
    $incident = [
        'code' => $code,
        'name' => 'Physical Assault / Injury',
        'severity' => 'High',
        'dept' => 'Barangay Police (Tanod)',
        'status' => 'Active'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Incident classification records updated successfully.';
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

<form action="<?= page_url($isEdit ? '/references/cases/edit?code=' . e($code) : '/references/cases/edit') ?>" method="POST" class="max-w-xl bg-white border border-slate-200 rounded-lg p-6">
    <div class="form-section-title">Incident Type Parameters</div>
    
    <div class="form-group">
        <label for="code" class="form-label form-label-required">Incident Classification Code</label>
        <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($incident['code']) ?>" placeholder="e.g. INC-PHYS" <?= $isEdit ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label for="name" class="form-label form-label-required">Incident Classification Label Name</label>
        <input type="text" id="name" name="name" class="form-input" required value="<?= e($incident['name']) ?>" placeholder="e.g. Physical Assault / Injury">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="severity" class="form-label form-label-required">Default Severity Rating</label>
            <select id="severity" name="severity" class="form-select" required>
                <option value="Low" <?= $incident['severity'] === 'Low' ? 'selected' : '' ?>>Low Priority</option>
                <option value="Medium" <?= $incident['severity'] === 'Medium' ? 'selected' : '' ?>>Medium Priority</option>
                <option value="High" <?= $incident['severity'] === 'High' ? 'selected' : '' ?>>High Priority</option>
            </select>
        </div>
        <div class="form-group">
            <label for="dept" class="form-label form-label-required">Default Assigned Desk</label>
            <input type="text" id="dept" name="dept" class="form-input" required value="<?= e($incident['dept']) ?>" placeholder="e.g. Barangay Police (Tanod)">
        </div>
    </div>

    <div class="form-group">
        <label for="status" class="form-label form-label-required">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Active" <?= $incident['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $incident['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <!-- Actions -->
    <div class="form-actions pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Case Settings</button>
        <a href="<?= page_url('/references/cases') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
