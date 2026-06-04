<?php
/**
 * Ad-hoc Report Generator Page
 */

$pageTitle = 'Ad-hoc Report Generator';
$pageSubtitle = 'Create flexible search queries across the database with configurable exports';
$breadcrumbs = [
    'Reports & Queries' => '',
    'Ad-hoc Query' => ''
];
$contentFile = __FILE__;

// Handle request to show mock results
$showResults = false;
$filtersApplied = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['generate'])) {
    $showResults = true;
    
    // Track filters applied for UI feedback
    if (!empty($_POST['gender'])) $filtersApplied[] = 'Gender: ' . e($_POST['gender']);
    if (!empty($_POST['purok'])) $filtersApplied[] = 'Purok: ' . e($_POST['purok']);
    if (!empty($_POST['civil_status'])) $filtersApplied[] = 'Civil: ' . e($_POST['civil_status']);
    if (!empty($_POST['age_min']) || !empty($_POST['age_max'])) {
        $filtersApplied[] = 'Age: ' . e($_POST['age_min'] ?? '0') . '-' . e($_POST['age_max'] ?? '99+');
    }
}

// Mock results
$results = [
    ['id' => 'RES-2026-0001', 'name' => 'Santos, Maria A.', 'gender' => 'Female', 'age' => 28, 'civil' => 'Single', 'purok' => 'Purok 1', 'contact' => '0917-123-4567'],
    ['id' => 'RES-2026-0006', 'name' => 'Aquino, Corazon F.', 'gender' => 'Female', 'age' => 71, 'civil' => 'Widowed', 'purok' => 'Purok 1', 'contact' => '0919-333-4444'],
    ['id' => 'RES-2026-0010', 'name' => 'San Agustin, Leonora J.', 'gender' => 'Female', 'age' => 31, 'civil' => 'Single', 'purok' => 'Purok 5', 'contact' => '0917-444-5555'],
];

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<!-- Query Form -->
<div class="bg-white border border-slate-200 rounded-lg p-5 mb-6">
    <form action="<?= page_url('/reports/adhoc?generate=1') ?>" method="POST" class="space-y-4">
        <h3 class="text-sm font-semibold text-slate-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Ad-hoc Filter Parameters</h3>
        
        <div class="form-row">
            <div class="form-group">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select text-xs">
                    <option value="">Any Gender</option>
                    <option value="Male" <?= isset($_POST['gender']) && $_POST['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= isset($_POST['gender']) && $_POST['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="purok" class="form-label">Purok / Zone</label>
                <select id="purok" name="purok" class="form-select text-xs">
                    <option value="">Any Purok / Zone</option>
                    <option value="Purok 1" <?= isset($_POST['purok']) && $_POST['purok'] === 'Purok 1' ? 'selected' : '' ?>>Purok 1</option>
                    <option value="Purok 2" <?= isset($_POST['purok']) && $_POST['purok'] === 'Purok 2' ? 'selected' : '' ?>>Purok 2</option>
                    <option value="Purok 3" <?= isset($_POST['purok']) && $_POST['purok'] === 'Purok 3' ? 'selected' : '' ?>>Purok 3</option>
                    <option value="Purok 4" <?= isset($_POST['purok']) && $_POST['purok'] === 'Purok 4' ? 'selected' : '' ?>>Purok 4</option>
                    <option value="Purok 5" <?= isset($_POST['purok']) && $_POST['purok'] === 'Purok 5' ? 'selected' : '' ?>>Purok 5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="civil_status" class="form-label">Civil Status</label>
                <select id="civil_status" name="civil_status" class="form-select text-xs">
                    <option value="">Any Civil Status</option>
                    <option value="Single" <?= isset($_POST['civil_status']) && $_POST['civil_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                    <option value="Married" <?= isset($_POST['civil_status']) && $_POST['civil_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
                    <option value="Widowed" <?= isset($_POST['civil_status']) && $_POST['civil_status'] === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                    <option value="Separated" <?= isset($_POST['civil_status']) && $_POST['civil_status'] === 'Separated' ? 'selected' : '' ?>>Separated</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group grid grid-cols-2 gap-2">
                <div>
                    <label for="age_min" class="form-label">Min Age</label>
                    <input type="number" id="age_min" name="age_min" class="form-input text-xs" placeholder="e.g. 18" value="<?= e($_POST['age_min'] ?? '') ?>">
                </div>
                <div>
                    <label for="age_max" class="form-label">Max Age</label>
                    <input type="number" id="age_max" name="age_max" class="form-input text-xs" placeholder="e.g. 60" value="<?= e($_POST['age_max'] ?? '') ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="export_format" class="form-label">Export Format</label>
                <select id="export_format" name="export_format" class="form-select text-xs">
                    <option value="HTML">On-Screen Table</option>
                    <option value="CSV">Comma Separated values (CSV)</option>
                    <option value="PDF">PDF Document (Print Ready)</option>
                </select>
            </div>
        </div>

        <div class="pt-2 flex gap-2">
            <button type="submit" class="btn btn-primary">Generate Query Report</button>
            <a href="<?= page_url('/reports/adhoc') ?>" class="btn btn-secondary">Clear Parameters</a>
        </div>
    </form>
</div>

<!-- Results Area -->
<?php if ($showResults): ?>
    <div class="data-table-wrapper">
        <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-semibold uppercase tracking-wider">
                <span>Query Results</span>
                <?php if (!empty($filtersApplied)): ?>
                    <span class="text-slate-300 font-normal">| Filters: <?= implode(', ', $filtersApplied) ?></span>
                <?php endif; ?>
            </div>
            <div class="inline-flex gap-1">
                <button onclick="alert('Exporting to Excel/CSV...');" class="btn btn-secondary btn-xs">Export CSV</button>
                <button onclick="alert('Exporting PDF...');" class="btn btn-secondary btn-xs text-accent-700">Export PDF</button>
            </div>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-36">ID</th>
                    <th>Resident Name</th>
                    <th class="w-24">Gender</th>
                    <th class="w-20">Age</th>
                    <th class="w-28">Civil Status</th>
                    <th class="w-32">Purok / Zone</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-6 text-slate-400">
                            No records found matching the query.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($results as $res): ?>
                        <tr>
                            <td class="font-mono text-xs text-slate-500"><?= e($res['id']) ?></td>
                            <td class="font-medium text-slate-800"><?= e($res['name']) ?></td>
                            <td><?= e($res['gender']) ?></td>
                            <td><?= e($res['age']) ?></td>
                            <td><?= e($res['civil']) ?></td>
                            <td><?= e($res['purok']) ?></td>
                            <td class="text-slate-500 font-mono text-xs"><?= e($res['contact']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="data-table-footer">
            <span>Showing <?= count($results) ?> of <?= count($results) ?> results matching query.</span>
        </div>
    </div>
<?php endif; ?>
