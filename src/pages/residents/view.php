<?php


$id = trim($_GET['id'] ?? 'RES-2026-0001');

$pageTitle = 'Resident Profile View';
$pageSubtitle = 'Details for Resident ID: ' . e($id);
$breadcrumbs = [
    'Resident Management' => '/residents',
    'Profile' => ''
];
$contentFile = __FILE__;


$resident = [
    'id' => $id,
    'first_name' => 'Maria',
    'last_name' => 'Santos',
    'middle_name' => 'A.',
    'gender' => 'Female',
    'birth_date' => '1998-05-15',
    'birth_place' => 'Manila, Metro Manila',
    'civil_status' => 'Single',
    'nationality' => 'Filipino',
    'religion' => 'Roman Catholic',
    'purok' => 'Purok 1',
    'street' => 'Rizal Street',
    'house_no' => '12-A',
    'contact_type' => 'Mobile Phone',
    'contact_value' => '0917-123-4567',
    'email' => 'maria.santos@gmail.com',
    'status' => 'Active',
    'notes' => 'Registered voter since 2018. Active volunteer at the Health Center. No records of incident reports or local cases.',
    'created_at' => '2026-01-10 08:32:10',
    'updated_at' => '2026-06-03 10:14:02',
    'updated_by' => 'Admin Jose'
];


ob_start();
?>
<a href="<?= page_url('/residents/edit?id=' . e($id)) ?>" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    Edit Profile
</a>
<button onclick="window.print();" class="btn btn-secondary">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
    Print Profile
</button>
<a href="<?= page_url('/residents') ?>" class="btn btn-secondary">Back to List</a>
<?php
$headerActions = ob_get_clean();

if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/base.php';
    exit;
}
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white border border-slate-200 rounded-lg p-5 text-center">
            <div class="w-24 h-24 rounded-full bg-gov-100 text-gov-700 flex items-center justify-center text-3xl font-bold mx-auto mb-4 border border-gov-200">
                <?= strtoupper(substr($resident['first_name'], 0, 1) . substr($resident['last_name'], 0, 1)) ?>
            </div>
            <h2 class="text-lg font-bold text-slate-800"><?= e($resident['first_name'] . ' ' . $resident['middle_name'] . ' ' . $resident['last_name']) ?></h2>
            <p class="text-xs font-mono text-slate-400 mt-1"><?= e($resident['id']) ?></p>
            
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-center gap-2">
                <span class="badge <?= $resident['status'] === 'Active' ? 'badge-active' : 'badge-inactive' ?>">
                    Status: <?= e($resident['status']) ?>
                </span>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-lg p-5 text-xs text-slate-500 space-y-2">
            <h3 class="font-semibold text-slate-700 uppercase tracking-wide border-b border-slate-100 pb-2 mb-2">Record Metadata</h3>
            <div class="flex justify-between">
                <span>Date Registered:</span>
                <span class="font-medium text-slate-700"><?= e($resident['created_at']) ?></span>
            </div>
            <div class="flex justify-between">
                <span>Last Updated:</span>
                <span class="font-medium text-slate-700"><?= e($resident['updated_at']) ?></span>
            </div>
            <div class="flex justify-between">
                <span>Updated By:</span>
                <span class="font-medium text-slate-700"><?= e($resident['updated_by']) ?></span>
            </div>
        </div>
    </div>

    
    <div class="lg:col-span-2 space-y-6">
        
        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h3 class="font-semibold text-slate-700 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Personal Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3.5 gap-x-6 text-sm">
                <div>
                    <span class="block text-xs text-slate-400">Full Name</span>
                    <span class="font-medium text-slate-700"><?= e($resident['last_name'] . ', ' . $resident['first_name'] . ' ' . $resident['middle_name']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Gender</span>
                    <span class="font-medium text-slate-700"><?= e($resident['gender']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Date of Birth</span>
                    <span class="font-medium text-slate-700"><?= e($resident['birth_date']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Place of Birth</span>
                    <span class="font-medium text-slate-700"><?= e($resident['birth_place']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Civil Status</span>
                    <span class="font-medium text-slate-700"><?= e($resident['civil_status']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Nationality</span>
                    <span class="font-medium text-slate-700"><?= e($resident['nationality']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Religion</span>
                    <span class="font-medium text-slate-700"><?= e($resident['religion']) ?></span>
                </div>
            </div>
        </div>

        
        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h3 class="font-semibold text-slate-700 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Residential Address</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3.5 gap-x-6 text-sm">
                <div>
                    <span class="block text-xs text-slate-400">Purok / Zone</span>
                    <span class="font-medium text-slate-700"><?= e($resident['purok']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Street</span>
                    <span class="font-medium text-slate-700"><?= e($resident['street'] ?: 'None') ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">House No. / Block</span>
                    <span class="font-medium text-slate-700"><?= e($resident['house_no'] ?: 'None') ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Barangay, City, Province</span>
                    <span class="font-medium text-slate-700">Barangay Juan, Manila, Metro Manila</span>
                </div>
            </div>
        </div>

        
        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h3 class="font-semibold text-slate-700 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Communication Details</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3.5 gap-x-6 text-sm">
                <div>
                    <span class="block text-xs text-slate-400">Preferred Channel</span>
                    <span class="font-medium text-slate-700"><?= e($resident['contact_type']) ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400">Contact Number</span>
                    <span class="font-medium text-slate-700 font-mono"><?= e($resident['contact_value']) ?></span>
                </div>
                <div class="sm:col-span-2">
                    <span class="block text-xs text-slate-400">Email Address</span>
                    <span class="font-medium text-slate-700 font-mono"><?= e($resident['email'] ?: 'None') ?></span>
                </div>
            </div>
        </div>

        
        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h3 class="font-semibold text-slate-700 uppercase tracking-wide border-b border-slate-100 pb-2 mb-3">Remarks & History Notes</h3>
            <p class="text-sm text-slate-600 leading-relaxed"><?= nl2br(e($resident['notes'])) ?></p>
        </div>
    </div>

</div>
