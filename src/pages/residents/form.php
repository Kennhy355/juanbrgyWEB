<?php
/**
 * Resident Create/Edit Form Page
 */

// Simple routing identification for Edit vs Create
$id = trim($_GET['id'] ?? '');
$isEdit = $id !== '';

$pageTitle = $isEdit ? 'Edit Resident Details' : 'Register New Resident';
$pageSubtitle = $isEdit ? 'Update details for Resident ID: ' . e($id) : 'Fill in the information to add a resident to the Master File';
$breadcrumbs = [
    'Resident Management' => '/residents',
    ($isEdit ? 'Edit' : 'Create') => ''
];
$contentFile = __FILE__;

// Mock current resident data for edit state
$resident = [
    'first_name' => '',
    'last_name' => '',
    'middle_name' => '',
    'gender' => 'Male',
    'birth_date' => '',
    'birth_place' => '',
    'civil_status' => 'Single',
    'nationality' => 'Filipino',
    'religion' => 'Roman Catholic',
    'purok' => 'Purok 1',
    'street' => '',
    'house_no' => '',
    'contact_type' => 'Mobile',
    'contact_value' => '',
    'email' => '',
    'status' => 'Active',
    'notes' => ''
];

if ($isEdit) {
    // Fill mock details matching the ID
    $resident = [
        'first_name' => 'Maria',
        'last_name' => 'Santos',
        'middle_name' => 'A.',
        'gender' => 'Female',
        'birth_date' => '1998-05-15',
        'birth_place' => 'Manila',
        'civil_status' => 'Single',
        'nationality' => 'Filipino',
        'religion' => 'Roman Catholic',
        'purok' => 'Purok 1',
        'street' => 'Rizal Street',
        'house_no' => '12-A',
        'contact_type' => 'Mobile',
        'contact_value' => '0917-123-4567',
        'email' => 'maria.santos@gmail.com',
        'status' => 'Active',
        'notes' => 'Registered voter. Permanent resident.'
    ];
}

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = $isEdit ? 'Resident records updated successfully.' : 'Resident registered successfully.';
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

<form action="<?= page_url($isEdit ? '/residents/edit?id=' . e($id) : '/residents/create') ?>" method="POST" class="space-y-6">

    <!-- Section 1: Personal Details -->
    <div class="form-section">
        <h2 class="form-section-title">Personal Details</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="last_name" class="form-label form-label-required">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-input" required value="<?= e($resident['last_name']) ?>" placeholder="e.g. Dela Cruz">
            </div>
            <div class="form-group">
                <label for="first_name" class="form-label form-label-required">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-input" required value="<?= e($resident['first_name']) ?>" placeholder="e.g. Juan">
            </div>
            <div class="form-group">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" class="form-input" value="<?= e($resident['middle_name']) ?>" placeholder="e.g. Aquino">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="gender" class="form-label form-label-required">Gender</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="Male" <?= $resident['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $resident['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $resident['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birth_date" class="form-label form-label-required">Date of Birth</label>
                <input type="date" id="birth_date" name="birth_date" class="form-input" required value="<?= e($resident['birth_date']) ?>">
            </div>
            <div class="form-group">
                <label for="birth_place" class="form-label">Place of Birth</label>
                <input type="text" id="birth_place" name="birth_place" class="form-input" value="<?= e($resident['birth_place']) ?>" placeholder="City / Province">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="civil_status" class="form-label form-label-required">Civil Status</label>
                <select id="civil_status" name="civil_status" class="form-select" required>
                    <option value="Single" <?= $resident['civil_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                    <option value="Married" <?= $resident['civil_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
                    <option value="Widowed" <?= $resident['civil_status'] === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                    <option value="Separated" <?= $resident['civil_status'] === 'Separated' ? 'selected' : '' ?>>Separated</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nationality" class="form-label form-label-required">Nationality</label>
                <input type="text" id="nationality" name="nationality" class="form-input" required value="<?= e($resident['nationality']) ?>" placeholder="e.g. Filipino">
            </div>
            <div class="form-group">
                <label for="religion" class="form-label">Religion</label>
                <input type="text" id="religion" name="religion" class="form-input" value="<?= e($resident['religion']) ?>" placeholder="e.g. Roman Catholic">
            </div>
        </div>
    </div>

    <!-- Section 2: Address Information -->
    <div class="form-section">
        <h2 class="form-section-title">Address Details</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="purok" class="form-label form-label-required">Purok / Zone</label>
                <select id="purok" name="purok" class="form-select" required>
                    <option value="Purok 1" <?= $resident['purok'] === 'Purok 1' ? 'selected' : '' ?>>Purok 1</option>
                    <option value="Purok 2" <?= $resident['purok'] === 'Purok 2' ? 'selected' : '' ?>>Purok 2</option>
                    <option value="Purok 3" <?= $resident['purok'] === 'Purok 3' ? 'selected' : '' ?>>Purok 3</option>
                    <option value="Purok 4" <?= $resident['purok'] === 'Purok 4' ? 'selected' : '' ?>>Purok 4</option>
                    <option value="Purok 5" <?= $resident['purok'] === 'Purok 5' ? 'selected' : '' ?>>Purok 5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="street" class="form-label">Street / Block</label>
                <input type="text" id="street" name="street" class="form-input" value="<?= e($resident['street']) ?>" placeholder="e.g. Rizal Street">
            </div>
            <div class="form-group">
                <label for="house_no" class="form-label">House No. / Building</label>
                <input type="text" id="house_no" name="house_no" class="form-input" value="<?= e($resident['house_no']) ?>" placeholder="e.g. 12-A">
            </div>
        </div>
    </div>

    <!-- Section 3: Contact & Communication Details -->
    <div class="form-section">
        <h2 class="form-section-title">Communication Details</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="contact_type" class="form-label">Primary Way of Comm.</label>
                <select id="contact_type" name="contact_type" class="form-select">
                    <option value="Mobile" <?= $resident['contact_type'] === 'Mobile' ? 'selected' : '' ?>>Mobile Phone</option>
                    <option value="Landline" <?= $resident['contact_type'] === 'Landline' ? 'selected' : '' ?>>Landline</option>
                    <option value="Email" <?= $resident['contact_type'] === 'Email' ? 'selected' : '' ?>>Email</option>
                    <option value="Letter" <?= $resident['contact_type'] === 'Letter' ? 'selected' : '' ?>>Letter / Written</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact_value" class="form-label form-label-required">Contact Number</label>
                <input type="text" id="contact_value" name="contact_value" class="form-input" required value="<?= e($resident['contact_value']) ?>" placeholder="e.g. 0917-123-4567">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" value="<?= e($resident['email']) ?>" placeholder="e.g. resident@gmail.com">
            </div>
        </div>
    </div>

    <!-- Section 4: System Fields -->
    <div class="form-section">
        <h2 class="form-section-title">Status & Remarks</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="status" class="form-label form-label-required">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="Active" <?= $resident['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $resident['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="notes" class="form-label">Remarks / Movement History Details</label>
            <textarea id="notes" name="notes" class="form-textarea" placeholder="Provide background information, voter registration history, transfer information..."><?= e($resident['notes']) ?></textarea>
        </div>
    </div>

    <!-- Actions -->
    <div class="form-actions bg-white border border-slate-200 rounded-lg p-4 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Save Changes' : 'Register Resident' ?></button>
        <a href="<?= page_url('/residents') ?>" class="btn btn-secondary">Cancel</a>
    </div>

</form>
