<?php


$pageTitle = 'Configure Barangay Master Details';
$pageSubtitle = 'Edit official municipality references, geographic codes, and council member entries';
$breadcrumbs = [
    'Reference Tables' => '',
    'Barangay Master' => '/references/barangay',
    'Set-up' => ''
];
$contentFile = __FILE__;


$barangay = [
    'code' => 'BRGY-001',
    'name' => 'Barangay Juan',
    'municipality_id' => '1', 
    'province_id' => '1',     
    'country_id' => '1',      
    'population' => '1482',
];

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Barangay Master profiles and geographic metadata updated successfully.';
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

<form action="<?= page_url('/references/barangay/edit') ?>" method="POST" class="space-y-6">

    
    <div class="form-section">
        <h2 class="form-section-title">Geographic & Reference Settings</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="code" class="form-label form-label-required">Barangay Reference Code</label>
                <input type="text" id="code" name="code" class="form-input font-mono" required value="<?= e($barangay['code']) ?>" placeholder="e.g. BRGY-001">
            </div>
            <div class="form-group">
                <label for="name" class="form-label form-label-required">Barangay Name</label>
                <input type="text" id="name" name="name" class="form-input" required value="<?= e($barangay['name']) ?>" placeholder="e.g. Barangay Juan">
            </div>
            <div class="form-group">
                <label for="population" class="form-label">Approx. Population</label>
                <input type="number" id="population" name="population" class="form-input" value="<?= e($barangay['population']) ?>" placeholder="e.g. 1500">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="municipality_id" class="form-label form-label-required">Municipality (Lookup)</label>
                <select id="municipality_id" name="municipality_id" class="form-select" required>
                    <option value="1" selected>Manila</option>
                    <option value="2">Quezon City</option>
                    <option value="3">Cebu City</option>
                </select>
            </div>
            <div class="form-group">
                <label for="province_id" class="form-label form-label-required">State / Province (Lookup)</label>
                <select id="province_id" name="province_id" class="form-select" required>
                    <option value="1" selected>Metro Manila</option>
                    <option value="2">Cebu</option>
                    <option value="3">Bulacan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="country_id" class="form-label form-label-required">Country (Lookup)</label>
                <select id="country_id" name="country_id" class="form-select" required>
                    <option value="1" selected>Philippines</option>
                    <option value="2">United States</option>
                </select>
            </div>
        </div>
    </div>

    
    <div class="form-section">
        <h2 class="form-section-title">Sangguniang Barangay Council Entries</h2>
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 bg-slate-50 p-4 border border-slate-200 rounded items-end">
                <div class="md:col-span-2">
                    <label class="form-label text-xs">Council Member Name</label>
                    <input type="text" class="form-input text-xs" value="Hon. Jose Rizal" placeholder="Full name">
                </div>
                <div>
                    <label class="form-label text-xs">Position / Assignment</label>
                    <select class="form-select text-xs">
                        <option selected>Barangay Captain</option>
                        <option>Kagawad (Peace & Order)</option>
                        <option>Kagawad (Education)</option>
                        <option>Kagawad (Finance)</option>
                        <option>SK Chairman</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="alert('Position Updated')" class="btn btn-secondary btn-sm w-full">Update Position</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 bg-slate-50 p-4 border border-slate-200 rounded items-end">
                <div class="md:col-span-2">
                    <label class="form-label text-xs">Council Member Name</label>
                    <input type="text" class="form-input text-xs" value="Hon. Andres Bonifacio" placeholder="Full name">
                </div>
                <div>
                    <label class="form-label text-xs">Position / Assignment</label>
                    <select class="form-select text-xs">
                        <option>Barangay Captain</option>
                        <option selected>Kagawad (Peace & Order)</option>
                        <option>Kagawad (Education)</option>
                        <option>Kagawad (Finance)</option>
                        <option>SK Chairman</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="alert('Position Updated')" class="btn btn-secondary btn-sm w-full">Update Position</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="form-actions bg-white border border-slate-200 rounded-lg p-4 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save Settings</button>
        <a href="<?= page_url('/references/barangay') ?>" class="btn btn-secondary">Cancel</a>
    </div>

</form>
