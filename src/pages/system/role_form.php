<?php
/**
 * User Role Maintenance Form Page
 */

$id = trim($_GET['id'] ?? '');
$isEdit = $id !== '';

$pageTitle = $isEdit ? 'Set-up Access Role' : 'Configure Access Role';
$pageSubtitle = $isEdit ? 'Modify permission checklist for Role ID: ' . e($id) : 'Define new role access configurations and module security rules';
$breadcrumbs = [
    'System Management' => '',
    'Roles' => '/system/roles',
    'Set-up' => ''
];
$contentFile = __FILE__;

// Mock configuration settings
$role = [
    'name' => '',
    'desc' => '',
    'permissions' => []
];

if ($isEdit) {
    $role = [
        'name' => 'Secretary Desk Officer',
        'desc' => 'Can manage residents, generate reports, approve documents, and edit lookups.',
        'permissions' => [
            'residents_view', 'residents_create', 'residents_edit',
            'reports_view', 'reports_custom', 'reports_adhoc',
            'approvals_rules', 'approvals_auth'
        ]
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Role permission parameters updated successfully.';
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

<form action="<?= page_url($isEdit ? '/system/roles/edit?id=' . e($id) : '/system/roles/edit') ?>" method="POST" class="space-y-6">

    <!-- Metadata settings -->
    <div class="form-section max-w-2xl">
        <h2 class="form-section-title">Access Role Information</h2>
        <div class="form-group">
            <label for="name" class="form-label form-label-required">Role Title Name</label>
            <input type="text" id="name" name="name" class="form-input" required value="<?= e($role['name']) ?>" placeholder="e.g. Secretary Desk Officer">
        </div>
        <div class="form-group">
            <label for="desc" class="form-label">Role Access Scope / Description</label>
            <input type="text" id="desc" name="desc" class="form-input" value="<?= e($role['desc']) ?>" placeholder="Summarize what users under this role are authorized to perform">
        </div>
    </div>

    <!-- Permissions checklist matrix grid -->
    <div class="form-section max-w-4xl">
        <h2 class="form-section-title">Module Permissions Matrix</h2>
        <div class="overflow-x-auto border border-slate-200 rounded">
            <table class="data-table">
                <thead>
                    <tr class="bg-slate-50">
                        <th>System Module</th>
                        <th class="w-28 text-center">View</th>
                        <th class="w-28 text-center">Create</th>
                        <th class="w-28 text-center">Edit</th>
                        <th class="w-28 text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-semibold text-xs text-slate-700">Resident Management</td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="residents_view" class="form-checkbox" <?= in_array('residents_view', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="residents_create" class="form-checkbox" <?= in_array('residents_create', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="residents_edit" class="form-checkbox" <?= in_array('residents_edit', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="residents_delete" class="form-checkbox" <?= in_array('residents_delete', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-xs text-slate-700">Reports & Queries</td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="reports_view" class="form-checkbox" <?= in_array('reports_view', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="reports_custom" class="form-checkbox" <?= in_array('reports_custom', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="reports_adhoc" class="form-checkbox" <?= in_array('reports_adhoc', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="reports_delete" class="form-checkbox" <?= in_array('reports_delete', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-xs text-slate-700">Approvals System</td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="approvals_view" class="form-checkbox" <?= in_array('approvals_view', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="approvals_rules" class="form-checkbox" <?= in_array('approvals_rules', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="approvals_auth" class="form-checkbox" <?= in_array('approvals_auth', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="approvals_delete" class="form-checkbox" <?= in_array('approvals_delete', $role['permissions']) ? 'checked' : '' ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-xs text-slate-700">Reference Tables</td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="references_view" class="form-checkbox" checked disabled>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="references_create" class="form-checkbox">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="references_edit" class="form-checkbox">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="permissions[]" value="references_delete" class="form-checkbox">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Actions -->
    <div class="form-actions bg-white border border-slate-200 rounded-lg p-4 flex items-center justify-end gap-2 max-w-4xl">
        <button type="submit" class="btn btn-primary">Save Role Configuration</button>
        <a href="<?= page_url('/system/roles') ?>" class="btn btn-secondary">Cancel</a>
    </div>

</form>
