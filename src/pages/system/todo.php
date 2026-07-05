<?php


$pageTitle = 'My Task List';
$pageSubtitle = 'Organize personal and departmental administrative tasks';
$breadcrumbs = [
    'System Management' => '',
    'TODO List' => ''
];
$contentFile = __FILE__;


$tasks = [
    ['id' => 1, 'task' => 'Verify voter registration listings for Purok 2', 'priority' => 'High', 'due' => '2026-06-05', 'status' => 'Pending'],
    ['id' => 2, 'task' => 'Compile and submit Q2 barangay health demographics report', 'priority' => 'Medium', 'due' => '2026-06-10', 'status' => 'Pending'],
    ['id' => 3, 'task' => 'Resolve pending clearance dispute for RES-2026-0004', 'priority' => 'High', 'due' => '2026-06-04', 'status' => 'Pending'],
    ['id' => 4, 'task' => 'Update Barangay Master File email credentials settings', 'priority' => 'Low', 'due' => '2026-06-15', 'status' => 'Completed'],
];

$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_task'])) {
        $successMsg = 'Task successfully added to your checklist.';
    } elseif (isset($_POST['complete_task'])) {
        $successMsg = 'Task marked as completed.';
    } elseif (isset($_POST['delete_task'])) {
        $successMsg = 'Task removed from your checklist.';
    }
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    
    <div class="bg-white border border-slate-200 rounded-lg p-5 h-fit">
        <h3 class="text-sm font-semibold text-slate-800 uppercase tracking-wide border-b border-slate-100 pb-2 mb-4">Add Task Card</h3>
        <form action="<?= page_url('/system/todo') ?>" method="POST" class="space-y-4">
            <input type="hidden" name="add_task" value="1">
            
            <div class="form-group">
                <label for="task" class="form-label form-label-required">Task Action description</label>
                <input type="text" id="task" name="task" class="form-input text-xs" required placeholder="Describe task..." value="Follow-up on senior health kit packages distribution">
            </div>

            <div class="form-group">
                <label for="priority" class="form-label form-label-required">Priority Level</label>
                <select id="priority" name="priority" class="form-select text-xs" required>
                    <option value="Low">Low Priority</option>
                    <option value="Medium">Medium Priority</option>
                    <option value="High" selected>High Priority</option>
                </select>
            </div>

            <div class="form-group">
                <label for="due" class="form-label form-label-required">Due Date Target</label>
                <input type="date" id="due" name="due" class="form-input text-xs" required value="2026-06-08">
            </div>

            <div class="pt-2 flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm w-full">Save Task</button>
            </div>
        </form>
    </div>

    
    <div class="lg:col-span-2">
        <div class="data-table-wrapper">
            <div class="data-table-toolbar flex justify-between items-center p-3 bg-slate-50 border-b border-slate-200">
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">My Task List Overview</span>
                <span class="text-xs text-slate-400 font-mono">Tasks: <?= count($tasks) ?></span>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-10">Done</th>
                        <th>Task Details / Description</th>
                        <th class="w-24 text-center">Priority</th>
                        <th class="w-28">Due Date</th>
                        <th class="w-32 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $t): ?>
                        <tr>
                            <td class="text-center">
                                <form action="<?= page_url('/system/todo') ?>" method="POST" class="inline">
                                    <input type="hidden" name="complete_task" value="1">
                                    <input type="checkbox" class="form-checkbox cursor-pointer" onchange="this.form.submit();" <?= $t['status'] === 'Completed' ? 'checked disabled' : '' ?>>
                                </form>
                            </td>
                            <td>
                                <span class="text-xs font-semibold text-slate-700 <?= $t['status'] === 'Completed' ? 'line-through text-slate-400' : '' ?>">
                                    <?= e($t['task']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php 
                                    $badge = 'badge-inactive';
                                    if ($t['priority'] === 'High') $badge = 'badge-rejected';
                                    if ($t['priority'] === 'Medium') $badge = 'badge-pending';
                                ?>
                                <span class="badge <?= $badge ?>"><?= e($t['priority']) ?></span>
                            </td>
                            <td class="text-xs font-mono text-slate-500 <?= $t['status'] === 'Completed' ? 'line-through text-slate-300' : '' ?>">
                                <?= e($t['due']) ?>
                            </td>
                            <td class="text-center">
                                <form action="<?= page_url('/system/todo') ?>" method="POST" class="inline-flex gap-1">
                                    <input type="hidden" name="delete_task" value="1">
                                    <button type="submit" class="btn btn-secondary btn-xs text-danger-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
