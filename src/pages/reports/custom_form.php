<?php


$id = trim($_GET['id'] ?? '');
$isEdit = $id !== '';

$pageTitle = $isEdit ? 'Set-up Custom Report Template' : 'Configure New Custom Report';
$pageSubtitle = $isEdit ? 'Modify configuration options for Custom Template ID: ' . e($id) : 'Define query parameters and metadata to save as a custom report template';
$breadcrumbs = [
    'Reports & Queries' => '',
    'Custom Reports' => '/reports/custom',
    'Set-up' => ''
];
$contentFile = __FILE__;


$template = [
    'name' => '',
    'desc' => '',
    'status' => 'Active',
    'entity_type' => 'Residents',
    'fields' => ['id', 'name', 'purok'],
    'filters' => [
        ['field' => 'age', 'op' => '>=', 'val' => '18'],
        ['field' => 'status', 'op' => '=', 'val' => 'Active']
    ]
];

if ($isEdit) {
    $template = [
        'name' => 'Active Male Voters in Purok 1',
        'desc' => 'Filtered query showing male residents aged 18+ in Purok 1.',
        'status' => 'Active',
        'entity_type' => 'Residents',
        'fields' => ['id', 'name', 'purok', 'contact'],
        'filters' => [
            ['field' => 'age', 'op' => '>=', 'val' => '18'],
            ['field' => 'gender', 'op' => '=', 'val' => 'Male'],
            ['field' => 'purok', 'op' => '=', 'val' => 'Purok 1']
        ]
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = $isEdit ? 'Custom report template saved successfully.' : 'Custom report template registered.';
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

<form action="<?= page_url($isEdit ? '/reports/custom/edit?id=' . e($id) : '/reports/custom/create') ?>" method="POST" class="space-y-6">

    
    <div class="form-section">
        <h2 class="form-section-title">Template Metadata</h2>
        <div class="form-row">
            <div class="form-group sm:col-span-2">
                <label for="name" class="form-label form-label-required">Report Name / Menu Label</label>
                <input type="text" id="name" name="name" class="form-input" required value="<?= e($template['name']) ?>" placeholder="e.g. Active Male Voters in Purok 1">
            </div>
            <div class="form-group">
                <label for="status" class="form-label form-label-required">Menu Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="Active" <?= $template['status'] === 'Active' ? 'selected' : '' ?>>Active (Visible on Menu)</option>
                    <option value="Inactive" <?= $template['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive (Hidden)</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="desc" class="form-label">Menu Item Description</label>
            <input type="text" id="desc" name="desc" class="form-input" value="<?= e($template['desc']) ?>" placeholder="A brief description about what this report is for">
        </div>
    </div>

    
    <div class="form-section">
        <h2 class="form-section-title">Query Parameters</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="entity_type" class="form-label form-label-required">Base Master File Entity</label>
                <select id="entity_type" name="entity_type" class="form-select" required>
                    <option value="Residents" <?= $template['entity_type'] === 'Residents' ? 'selected' : '' ?>>Residents Master File</option>
                    <option value="Blotter" <?= $template['entity_type'] === 'Blotter' ? 'selected' : '' ?>>Cases / Incidents Log</option>
                    <option value="Users" <?= $template['entity_type'] === 'Users' ? 'selected' : '' ?>>System Users</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label font-semibold mb-2">Display Columns</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-50 p-4 border border-slate-200 rounded">
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="id" class="form-checkbox" <?= in_array('id', $template['fields']) ? 'checked' : '' ?>>
                    Record ID
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="name" class="form-checkbox" <?= in_array('name', $template['fields']) ? 'checked' : '' ?>>
                    Full Name
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="gender" class="form-checkbox" <?= in_array('gender', $template['fields']) ? 'checked' : '' ?>>
                    Gender
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="age" class="form-checkbox" <?= in_array('age', $template['fields']) ? 'checked' : '' ?>>
                    Age / DOB
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="purok" class="form-checkbox" <?= in_array('purok', $template['fields']) ? 'checked' : '' ?>>
                    Purok / Zone
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="contact" class="form-checkbox" <?= in_array('contact', $template['fields']) ? 'checked' : '' ?>>
                    Contact Details
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="civil" class="form-checkbox" <?= in_array('civil', $template['fields']) ? 'checked' : '' ?>>
                    Civil Status
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="fields[]" value="religion" class="form-checkbox" <?= in_array('religion', $template['fields']) ? 'checked' : '' ?>>
                    Religion
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label font-semibold mb-2">Query Filters (AND)</label>
            <div class="space-y-3">
                <?php foreach ($template['filters'] as $idx => $filt): ?>
                    <div class="flex items-center gap-2">
                        <select name="filters[<?= $idx ?>][field]" class="form-select text-xs w-48">
                            <option value="age" <?= $filt['field'] === 'age' ? 'selected' : '' ?>>Age</option>
                            <option value="gender" <?= $filt['field'] === 'gender' ? 'selected' : '' ?>>Gender</option>
                            <option value="purok" <?= $filt['field'] === 'purok' ? 'selected' : '' ?>>Purok / Zone</option>
                            <option value="status" <?= $filt['field'] === 'status' ? 'selected' : '' ?>>Status</option>
                        </select>
                        <select name="filters[<?= $idx ?>][op]" class="form-select text-xs w-28">
                            <option value="=" <?= $filt['op'] === '=' ? 'selected' : '' ?>>Equals</option>
                            <option value="!=" <?= $filt['op'] === '!=' ? 'selected' : '' ?>>Not Equals</option>
                            <option value=">=" <?= $filt['op'] === '>=' ? 'selected' : '' ?>>Greater than/Equal</option>
                            <option value="<=" <?= $filt['op'] === '<=' ? 'selected' : '' ?>>Less than/Equal</option>
                        </select>
                        <input type="text" name="filters[<?= $idx ?>][val]" class="form-input text-xs" style="margin-top: 0;" placeholder="Value..." value="<?= e($filt['val']) ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    
    <div class="form-actions bg-white border border-slate-200 rounded-lg p-4 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Template Settings</button>
        <a href="<?= page_url('/reports/custom') ?>" class="btn btn-secondary">Cancel</a>
    </div>

</form>
