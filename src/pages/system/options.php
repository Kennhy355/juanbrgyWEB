<?php
/**
 * System-wide Options Page
 */

$pageTitle = 'System-wide Options';
$pageSubtitle = 'Configure global settings, soft-switches, and notification parameters for the application';
$breadcrumbs = [
    'System Management' => '',
    'Global Options' => ''
];
$contentFile = __FILE__;

// Mock current option state
$options = [
    'app_name' => 'Barangay Juan MIS',
    'allow_voter_edit' => 'yes',
    'enforce_pwd_age' => 'no',
    'sms_notifications' => 'yes',
    'email_notifications' => 'yes',
    'audit_logging' => 'yes',
    'session_timeout' => '30'
];

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $successMsg = 'Global system configurations saved successfully.';
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

<form action="<?= page_url('/system/options') ?>" method="POST" class="space-y-6 max-w-3xl">

    <!-- Group 1: General Settings -->
    <div class="form-section">
        <h2 class="form-section-title">General Platform Settings</h2>
        <div class="form-group">
            <label for="app_name" class="form-label form-label-required">Application Portal Title Label</label>
            <input type="text" id="app_name" name="app_name" class="form-input" required value="<?= e($options['app_name']) ?>" placeholder="e.g. Barangay Juan MIS">
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="session_timeout" class="form-label form-label-required">Inactive Session Expiration Timeout (minutes)</label>
                <input type="number" id="session_timeout" name="session_timeout" class="form-input font-mono" required value="<?= e($options['session_timeout']) ?>" min="5" max="180">
            </div>
        </div>
    </div>

    <!-- Group 2: Document & Registry Toggles -->
    <div class="form-section text-sm space-y-4">
        <h2 class="form-section-title">Document & Resident File Settings</h2>
        
        <label class="flex items-start gap-2.5 cursor-pointer">
            <input type="checkbox" name="allow_voter_edit" class="form-checkbox mt-0.5" value="yes" checked>
            <div>
                <span class="block font-semibold text-slate-700">Voter Registry Integration Toggle</span>
                <span class="block text-xs text-slate-400">Allows desk officers to toggle registration check status flags on resident profiles.</span>
            </div>
        </label>

        <label class="flex items-start gap-2.5 cursor-pointer">
            <input type="checkbox" name="audit_logging" class="form-checkbox mt-0.5" value="yes" checked>
            <div>
                <span class="block font-semibold text-slate-700">Detailed Action Audit Log Tracking</span>
                <span class="block text-xs text-slate-400">Stores detailed audit entries of modifications for compliance reporting.</span>
            </div>
        </label>
    </div>

    <!-- Group 3: Automated Notifications Channels -->
    <div class="form-section text-sm space-y-4">
        <h2 class="form-section-title">Delivery Channels (Notification soft-switches)</h2>
        
        <label class="flex items-start gap-2.5 cursor-pointer">
            <input type="checkbox" name="sms_notifications" class="form-checkbox mt-0.5" value="yes" checked>
            <div>
                <span class="block font-semibold text-slate-700">Auto-transmit SMS Text Notifications</span>
                <span class="block text-xs text-slate-400">Automatically push text warnings upon approval rule matching confirmations.</span>
            </div>
        </label>

        <label class="flex items-start gap-2.5 cursor-pointer">
            <input type="checkbox" name="email_notifications" class="form-checkbox mt-0.5" value="yes" checked>
            <div>
                <span class="block font-semibold text-slate-700">Auto-transmit Email Notifications</span>
                <span class="block text-xs text-slate-400">Automatically push emails containing PDF document attachments ready for pick-up.</span>
            </div>
        </label>
    </div>

    <!-- Actions -->
    <div class="form-actions bg-white border border-slate-200 rounded-lg p-4 flex items-center justify-end gap-2">
        <button type="submit" class="btn btn-primary">Save System Config</button>
        <a href="<?= page_url('/') ?>" class="btn btn-secondary">Cancel</a>
    </div>

</form>
