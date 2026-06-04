<?php
/**
 * Cases / Type of Incident Reference List Page
 */

$pageTitle = 'Cases & Incident Types Master';
$pageSubtitle = 'Manage categories of incidents, dispute models, and peace & order desk categories';
$breadcrumbs = [
    'Reference Tables' => '',
    'Cases / Incidents Master' => ''
];
$contentFile = __FILE__;

// Mock incident types
$incidents = [
    ['code' => 'INC-THEFT', 'name' => 'Theft / Robbery', 'severity' => 'Medium', 'dept' => 'KP Desk (Katarungang Pambarangay)', 'status' => 'Active'],
    ['code' => 'INC-PHYS', 'name' => 'Physical Assault / Injury', 'severity' => 'High', 'dept' => 'Barangay Police (Tanod)', 'status' => 'Active'],
    ['code' => 'INC-DISP', 'name' => 'Neighborhood Boundary Dispute', 'severity' => 'Low', 'dept' => 'Lupon Tagapamayapa Council', 'status' => 'Active'],
    ['code' => 'INC-NOIS', 'name' => 'Nuisance / Excessive Noise Complaint', 'severity' => 'Low', 'dept' => 'Barangay Police (Tanod)', 'status' => 'Active'],
    ['code' => 'INC-DOMS', 'name' => 'Domestic Violence / Family Conflict', 'severity' => 'High', 'dept' => 'VAWC Desk Officer', 'status' => 'Active'],
];

// Set header actions
ob_start();
?>
<a href="<?= page_url('/references/cases/edit') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Case Incident Type
</a>
<?php
$headerActions = ob_get_clean();

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="data-table-wrapper">
    <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
        <div class="search-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input text-xs" placeholder="Search case type..." oninput="alert('Filtering cases...');">
        </div>
        <span class="text-xs text-slate-400 font-mono">Total Types: <?= count($incidents) ?></span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">Incident Code</th>
                <th>Incident Classification Name</th>
                <th class="w-36">Default Severity</th>
                <th>Assigned Dept Desk</th>
                <th class="w-24 text-center">Status</th>
                <th class="w-24 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incidents as $inc): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-500"><?= e($inc['code']) ?></td>
                    <td class="font-medium text-slate-800 text-xs"><?= e($inc['name']) ?></td>
                    <td>
                        <?php 
                            $badge = 'badge-info';
                            if ($inc['severity'] === 'High') $badge = 'badge-rejected';
                            if ($inc['severity'] === 'Medium') $badge = 'badge-pending';
                        ?>
                        <span class="badge <?= $badge ?>"><?= e($inc['severity']) ?></span>
                    </td>
                    <td class="text-xs text-slate-600"><?= e($inc['dept']) ?></td>
                    <td class="text-center">
                        <span class="badge <?= $inc['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                            <?= e($inc['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= page_url('/references/cases/edit?code=' . $inc['code']) ?>" class="btn btn-secondary btn-xs">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
