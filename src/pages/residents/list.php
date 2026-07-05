<?php


$pageTitle = 'Resident Master File List';
$pageSubtitle = 'Search, filter, and manage all registered residents in Barangay Juan';
$breadcrumbs = [
    'Resident Management' => '',
    'List' => ''
];
$contentFile = __FILE__;


$residents = [
    ['id' => 'RES-2026-0001', 'first_name' => 'Maria', 'last_name' => 'Santos', 'middle_name' => 'A.', 'gender' => 'Female', 'purok' => 'Purok 1', 'contact' => '0917-123-4567', 'status' => 'Active', 'age' => 28],
    ['id' => 'RES-2026-0002', 'first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'middle_name' => 'B.', 'gender' => 'Male', 'purok' => 'Purok 3', 'contact' => '0918-987-6543', 'status' => 'Active', 'age' => 35],
    ['id' => 'RES-2026-0003', 'first_name' => 'Pedro', 'last_name' => 'Penduko', 'middle_name' => 'C.', 'gender' => 'Male', 'purok' => 'Purok 2', 'contact' => '0922-456-7890', 'status' => 'Active', 'age' => 42],
    ['id' => 'RES-2026-0004', 'first_name' => 'Gloria', 'last_name' => 'Macapagal', 'middle_name' => 'D.', 'gender' => 'Female', 'purok' => 'Purok 5', 'contact' => '0915-777-8888', 'status' => 'Active', 'age' => 54],
    ['id' => 'RES-2026-0005', 'first_name' => 'Ferdinand', 'last_name' => 'Marcos', 'middle_name' => 'E.', 'gender' => 'Male', 'purok' => 'Purok 4', 'contact' => '0908-111-2222', 'status' => 'Inactive', 'age' => 67],
    ['id' => 'RES-2026-0006', 'first_name' => 'Corazon', 'last_name' => 'Aquino', 'middle_name' => 'F.', 'gender' => 'Female', 'purok' => 'Purok 1', 'contact' => '0919-333-4444', 'status' => 'Active', 'age' => 71],
    ['id' => 'RES-2026-0007', 'first_name' => 'Joseph', 'last_name' => 'Estrada', 'middle_name' => 'G.', 'gender' => 'Male', 'purok' => 'Purok 3', 'contact' => '0932-555-6666', 'status' => 'Active', 'age' => 61],
    ['id' => 'RES-2026-0008', 'first_name' => 'Rodrigo', 'last_name' => 'Duterte', 'middle_name' => 'H.', 'gender' => 'Male', 'purok' => 'Purok 2', 'contact' => '0920-777-9999', 'status' => 'Active', 'age' => 75],
    ['id' => 'RES-2026-0009', 'first_name' => 'Manuel', 'last_name' => 'Quezon', 'middle_name' => 'I.', 'gender' => 'Male', 'purok' => 'Purok 4', 'contact' => '0905-222-3333', 'status' => 'Inactive', 'age' => 88],
    ['id' => 'RES-2026-0010', 'first_name' => 'Leonora', 'last_name' => 'San Agustin', 'middle_name' => 'J.', 'gender' => 'Female', 'purok' => 'Purok 5', 'contact' => '0917-444-5555', 'status' => 'Active', 'age' => 31],
];


$search = trim($_GET['search'] ?? '');
$filterPurok = trim($_GET['purok'] ?? '');
$filterStatus = trim($_GET['status'] ?? '');

$filteredResidents = [];
foreach ($residents as $res) {
    if ($search !== '') {
        $fullName = strtolower($res['first_name'] . ' ' . $res['last_name'] . ' ' . $res['id']);
        if (strpos($fullName, strtolower($search)) === false) {
            continue;
        }
    }
    if ($filterPurok !== '' && $res['purok'] !== $filterPurok) {
        continue;
    }
    if ($filterStatus !== '' && $res['status'] !== $filterStatus) {
        continue;
    }
    $filteredResidents[] = $res;
}


ob_start();
?>
<a href="<?= page_url('/residents/create') ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Resident
</a>
<?php
$headerActions = ob_get_clean();

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="data-table-wrapper">
    
    <form action="<?= page_url('/residents') ?>" method="GET" class="data-table-toolbar flex flex-wrap items-center justify-between gap-3 p-3 bg-slate-50 border-b border-slate-200">
        <div class="flex items-center gap-2">
            <div class="search-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="search" class="search-input text-xs" placeholder="Search ID or name..." value="<?= e($search) ?>">
            </div>
            
            <select name="purok" class="form-select py-1.5 px-3 text-xs w-36">
                <option value="">All Purok/Zone</option>
                <option value="Purok 1" <?= $filterPurok === 'Purok 1' ? 'selected' : '' ?>>Purok 1</option>
                <option value="Purok 2" <?= $filterPurok === 'Purok 2' ? 'selected' : '' ?>>Purok 2</option>
                <option value="Purok 3" <?= $filterPurok === 'Purok 3' ? 'selected' : '' ?>>Purok 3</option>
                <option value="Purok 4" <?= $filterPurok === 'Purok 4' ? 'selected' : '' ?>>Purok 4</option>
                <option value="Purok 5" <?= $filterPurok === 'Purok 5' ? 'selected' : '' ?>>Purok 5</option>
            </select>

            <select name="status" class="form-select py-1.5 px-3 text-xs w-32">
                <option value="">All Status</option>
                <option value="Active" <?= $filterStatus === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $filterStatus === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>

            <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
            <?php if ($search || $filterPurok || $filterStatus): ?>
                <a href="<?= page_url('/residents') ?>" class="btn btn-secondary btn-sm text-slate-500">Reset</a>
            <?php endif; ?>
        </div>
        <div class="text-xs text-slate-500 font-medium">
            Showing <?= count($filteredResidents) ?> of <?= count($residents) ?> records
        </div>
    </form>

    
    <table class="data-table">
        <thead>
            <tr>
                <th class="w-36">ID</th>
                <th>Full Name</th>
                <th class="w-20">Age</th>
                <th class="w-24">Gender</th>
                <th class="w-36">Purok / Zone</th>
                <th>Contact</th>
                <th class="w-28 text-center">Status</th>
                <th class="w-28 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($filteredResidents)): ?>
                <tr>
                    <td colspan="8" class="text-center py-6 text-slate-400">
                        No residents found matching the search criteria.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($filteredResidents as $res): ?>
                    <tr>
                        <td class="font-mono text-xs text-slate-500"><?= e($res['id']) ?></td>
                        <td class="font-medium text-slate-800">
                            <?= e($res['last_name'] . ', ' . $res['first_name'] . ' ' . $res['middle_name']) ?>
                        </td>
                        <td><?= e($res['age']) ?></td>
                        <td><?= e($res['gender']) ?></td>
                        <td><?= e($res['purok']) ?></td>
                        <td class="text-slate-500 font-mono text-xs"><?= e($res['contact']) ?></td>
                        <td class="text-center">
                            <span class="badge <?= $res['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                                <?= e($res['status']) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="inline-flex gap-1">
                                <a href="<?= page_url('/residents/view?id=' . $res['id']) ?>" class="btn btn-secondary btn-xs" title="View Profile">View</a>
                                <a href="<?= page_url('/residents/edit?id=' . $res['id']) ?>" class="btn btn-secondary btn-xs text-accent-700" title="Edit Profile">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    
    <div class="data-table-footer">
        <div>
            Page 1 of 1
        </div>
        <div class="pagination">
            <button class="pagination-btn" disabled>&lt; Previous</button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn" disabled>Next &gt;</button>
        </div>
    </div>
</div>
