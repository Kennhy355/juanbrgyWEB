<?php
/**
 * Barangay Master File List Page
 */

$pageTitle = 'Barangay Master File';
$pageSubtitle = 'Manage barangay information details and Sangguniang Barangay council positions';
$breadcrumbs = [
    'Reference Tables' => '',
    'Barangay Master' => ''
];
$contentFile = __FILE__;

// Mock barangay profile data
$barangay = [
    'code' => 'BRGY-001',
    'name' => 'Barangay Juan',
    'municipality' => 'Manila',
    'province' => 'Metro Manila',
    'region' => 'National Capital Region (NCR)',
    'population' => '1,482',
    'captain' => 'Hon. Jose Rizal',
];

// Mock Sangguniang Barangay council entries
$council = [
    ['name' => 'Hon. Jose Rizal', 'position' => 'Barangay Captain', 'term' => '2023 - 2026', 'contact' => '0917-111-2222', 'status' => 'Active'],
    ['name' => 'Hon. Andres Bonifacio', 'position' => 'Kagawad (Peace & Order)', 'term' => '2023 - 2026', 'contact' => '0918-333-4444', 'status' => 'Active'],
    ['name' => 'Hon. Apolinario Mabini', 'position' => 'Kagawad (Education / Legal)', 'term' => '2023 - 2026', 'contact' => '0915-555-6666', 'status' => 'Active'],
    ['name' => 'Hon. Marcelo H. del Pilar', 'position' => 'Kagawad (Finance)', 'term' => '2023 - 2026', 'contact' => '0908-777-8888', 'status' => 'Active'],
    ['name' => 'Hon. Melchora Aquino', 'position' => 'Kagawad (Health & Social Services)', 'term' => '2023 - 2026', 'contact' => '0919-999-0000', 'status' => 'Active'],
    ['name' => 'Hon. Emilio Jacinto', 'position' => 'SK Chairman', 'term' => '2023 - 2026', 'contact' => '0922-222-3333', 'status' => 'Active'],
];

// Set header actions
ob_start();
?>
<a href="<?= page_url('/references/barangay/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    Edit Master Profile
</a>
<?php
$headerActions = ob_get_clean();

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Barangay Details Card -->
    <div class="bg-white border border-slate-200 rounded-lg p-5 h-fit">
        <h3 class="font-semibold text-slate-700 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Official Information</h3>
        <div class="space-y-3.5 text-sm">
            <div>
                <span class="block text-xs text-slate-400">Barangay Name</span>
                <span class="font-medium text-slate-700"><?= e($barangay['name']) ?></span>
            </div>
            <div>
                <span class="block text-xs text-slate-400">Code Reference</span>
                <span class="font-mono text-xs text-slate-700 font-medium"><?= e($barangay['code']) ?></span>
            </div>
            <div>
                <span class="block text-xs text-slate-400">City / Municipality</span>
                <span class="font-medium text-slate-700"><?= e($barangay['municipality']) ?></span>
            </div>
            <div>
                <span class="block text-xs text-slate-400">State / Province</span>
                <span class="font-medium text-slate-700"><?= e($barangay['province']) ?></span>
            </div>
            <div>
                <span class="block text-xs text-slate-400">Region</span>
                <span class="font-medium text-slate-700"><?= e($barangay['region']) ?></span>
            </div>
            <div>
                <span class="block text-xs text-slate-400">Approx. Population</span>
                <span class="font-medium text-slate-700"><?= e($barangay['population']) ?></span>
            </div>
        </div>
    </div>

    <!-- Sangguniang Barangay Council Members List -->
    <div class="lg:col-span-2">
        <div class="data-table-wrapper">
            <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Sangguniang Barangay Council</span>
                <span class="text-xs text-slate-400 font-mono">Term: 2023 - 2026</span>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Council Member Name</th>
                        <th class="w-56">Position / Committee Assignment</th>
                        <th>Active Term</th>
                        <th>Contact Number</th>
                        <th class="w-24 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($council as $member): ?>
                        <tr>
                            <td class="font-medium text-slate-800 text-xs"><?= e($member['name']) ?></td>
                            <td class="text-xs font-semibold text-slate-600"><?= e($member['position']) ?></td>
                            <td class="text-xs text-slate-500"><?= e($member['term']) ?></td>
                            <td class="text-xs font-mono text-slate-500"><?= e($member['contact']) ?></td>
                            <td class="text-center">
                                <span class="badge badge-active"><?= e($member['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
