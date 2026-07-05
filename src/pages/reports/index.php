<?php


$pageTitle = 'Barangay Reports';
$pageSubtitle = 'Access and download official barangay reports, statistical lists, and summaries';
$breadcrumbs = [
    'Reports & Queries' => '',
    'Standard Reports' => ''
];
$contentFile = __FILE__;


$reports = [
    ['code' => 'REP-DEMO-01', 'name' => 'Barangay Demographics Summary', 'category' => 'Demographics', 'desc' => 'Total resident count by Purok, age groups, and gender breakdown.'],
    ['code' => 'REP-VOTE-02', 'name' => 'Registered Voter Registry', 'category' => 'Electoral', 'desc' => 'List of registered voters grouped by Purok / Zone.'],
    ['code' => 'REP-BLOT-03', 'name' => 'Incident blotter Log', 'category' => 'Peace & Order', 'desc' => 'Cases and incident reports logged in the current calendar year.'],
    ['code' => 'REP-COMM-04', 'name' => 'Communication Channels Audit', 'category' => 'Administrative', 'desc' => 'Review of preferred contact types for communications outreach.'],
    ['code' => 'REP-INDG-05', 'name' => 'Indigency Certificate Ledger', 'category' => 'Social Services', 'desc' => 'Summary of certificates of indigency issued per month.'],
    ['code' => 'REP-SENR-06', 'name' => 'Senior Citizens Master File', 'category' => 'Demographics', 'desc' => 'List of senior residents (age 60 and above) for benefit mapping.'],
];

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="data-table-wrapper">
    <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Available Reports</span>
        <span class="text-xs text-slate-400 font-mono">Total: <?= count($reports) ?> categories</span>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th class="w-32">Report Code</th>
                <th class="w-72">Report Name</th>
                <th class="w-40">Category</th>
                <th>Description</th>
                <th class="w-48 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $rep): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($rep['code']) ?></td>
                    <td class="font-semibold text-slate-700"><?= e($rep['name']) ?></td>
                    <td>
                        <span class="badge badge-info"><?= e($rep['category']) ?></span>
                    </td>
                    <td class="text-slate-500 text-xs"><?= e($rep['desc']) ?></td>
                    <td class="text-center">
                        <div class="inline-flex gap-1">
                            <a href="#" onclick="alert('Viewing Report: <?= e($rep['name']) ?>'); return false;" class="btn btn-secondary btn-xs">View</a>
                            <a href="#" onclick="alert('Sending to Printer: <?= e($rep['name']) ?>'); return false;" class="btn btn-secondary btn-xs">Print</a>
                            <a href="#" onclick="alert('Exporting PDF for: <?= e($rep['name']) ?>'); return false;" class="btn btn-secondary btn-xs text-accent-700">PDF</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
