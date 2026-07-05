<?php


$pageTitle = 'Dashboard';
$pageSubtitle = 'Welcome to the Barangay Juan Management Information System';
$breadcrumbs = []; 
$contentFile = __FILE__;


$stats = [
    'total_residents'   => ['val' => '1,482', 'color' => 'text-accent-600',  'desc' => 'Registered residents'],
    'pending_approvals' => ['val' => '8',     'color' => 'text-warning-600',  'desc' => 'Requests waiting review'],
    'active_cases'      => ['val' => '5',     'color' => 'text-danger-600',   'desc' => 'Blotter / incidents reports'],
    'message_count'     => ['val' => '10',    'color' => 'text-success-600',  'desc' => 'Announcements posted'],
];

$messages = [
    ['date' => '2026-06-03', 'from' => 'Hon. Jose Rizal (Captain)', 'subject' => 'Monthly Sangguniang Barangay Council Assembly', 'status' => 'Urgent'],
    ['date' => '2026-06-02', 'from' => 'DOH Barangay Health Center', 'subject' => 'Free Immunization & Health Checkup Schedule', 'status' => 'Info'],
    ['date' => '2026-06-01', 'from' => 'Purok 1 Leader', 'subject' => 'Community Clean-Up Drive this Saturday', 'status' => 'Important'],
    ['date' => '2026-05-30', 'from' => 'Barangay Secretary', 'subject' => 'New Guidelines for Cedula (Community Tax Certificate) Issuance', 'status' => 'Standard'],
    ['date' => '2026-05-28', 'from' => 'KP Desk Officer', 'subject' => 'Katarungang Pambarangay Mediation Seminar', 'status' => 'Standard'],
    ['date' => '2026-05-25', 'from' => 'Hon. Jose Rizal (Captain)', 'subject' => 'Distribution of Relief & Calamity Assistance Kits', 'status' => 'Important'],
    ['date' => '2026-05-22', 'from' => 'Barangay Treasurer', 'subject' => 'Submission of Financial Reports for Q2 2026', 'status' => 'Important'],
    ['date' => '2026-05-20', 'from' => 'DILG Office', 'subject' => 'Mandatory Compliance Training for Local Appointees', 'status' => 'Urgent'],
    ['date' => '2026-05-18', 'from' => 'Barangay Police (Tanod)', 'subject' => 'Enhanced Night Patrols & Curfew Hours Implementation', 'status' => 'Standard'],
    ['date' => '2026-05-15', 'from' => 'SK Chairman', 'subject' => 'Youth Sports Fest and Leadership Bootcamp 2026', 'status' => 'Info'],
];

if (!isset($templateRendered)) {
    include __DIR__ . '/../templates/base.php';
    exit;
}
?>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    
    <div class="lg:col-span-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 sm:grid-rows-2 lg:grid-rows-4 gap-3 lg:h-[calc(100%-12px)]">
        <?php foreach ($stats as $key => $data): ?>
            <div class="stat-card h-full">
                <div class="stat-card-value <?= $data['color'] ?>"><?= e($data['val']) ?></div>
                <div class="stat-card-label"><?= e($data['desc']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-lg p-5">
        <h2 class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gov-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
            Population Overview
        </h2>
        <div style="position: relative; max-width: 420px; margin: 0 auto; padding: 10px 0 20px 0;">
            <canvas id="dashboardPieChart"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('dashboardPieChart').getContext('2d');

    const data = {
        labels: [
            'Registered Residents',
            'Pending Approvals',
            'Active Cases',
            'Announcements Posted'
        ],
        datasets: [{
            data: [
                <?= (int) str_replace(',', '', $stats['total_residents']['val']) ?>,
                <?= (int) str_replace(',', '', $stats['pending_approvals']['val']) ?>,
                <?= (int) str_replace(',', '', $stats['active_cases']['val']) ?>,
                <?= (int) str_replace(',', '', $stats['message_count']['val']) ?>
            ],
            backgroundColor: [
                'rgba(59, 130, 246, 0.85)',
                'rgba(245, 158, 11, 0.85)',
                'rgba(239, 68, 68, 0.85)',
                'rgba(16, 185, 129, 0.85)'
            ],
            borderColor: [
                'rgba(59, 130, 246, 1)',
                'rgba(245, 158, 11, 1)',
                'rgba(239, 68, 68, 1)',
                'rgba(16, 185, 129, 1)'
            ],
            borderWidth: 2,
            hoverOffset: 18,
            borderRadius: 4
        }]
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '55%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        font: {
                            family: "'Inter', sans-serif",
                            size: 12,
                            weight: '500'
                        },
                        color: '#475569'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { family: "'Inter', sans-serif", size: 13, weight: '600' },
                    bodyFont: { family: "'Inter', sans-serif", size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    boxPadding: 6,
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = ((value / total) * 100).toFixed(1);
                            return ' ' + context.label + ': ' + value.toLocaleString() + ' (' + pct + '%)';
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 800,
                easing: 'easeOutQuart'
            }
        }
    });
});
</script>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-lg p-5">
        <h2 class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gov-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Barangay Announcements & Messages
        </h2>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-28">Date</th>
                        <th>From</th>
                        <th>Subject</th>
                        <th class="w-24 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td class="text-slate-500 text-xs"><?= e($msg['date']) ?></td>
                            <td class="font-medium text-xs text-slate-700"><?= e($msg['from']) ?></td>
                            <td class="text-xs max-w-xs truncate" title="<?= e($msg['subject']) ?>"><?= e($msg['subject']) ?></td>
                            <td class="text-center">
                                <?php 
                                    $badge = 'badge-inactive';
                                    if ($msg['status'] === 'Urgent') $badge = 'badge-rejected';
                                    if ($msg['status'] === 'Important') $badge = 'badge-pending';
                                    if ($msg['status'] === 'Info') $badge = 'badge-info';
                                ?>
                                <span class="badge <?= $badge ?>"><?= e($msg['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="space-y-6">
        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h2 class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="<?= page_url('/residents/create') ?>" class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded hover:bg-slate-50 text-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-accent-600 mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    <span class="text-xs font-semibold text-slate-700">Add Resident</span>
                </a>
                <a href="<?= page_url('/reports/adhoc') ?>" class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded hover:bg-slate-50 text-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-accent-600 mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span class="text-xs font-semibold text-slate-700">Query Filter</span>
                </a>
                <a href="<?= page_url('/approvals/authorization') ?>" class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded hover:bg-slate-50 text-center transition-colors relative">
                    <span class="absolute top-2 right-2 bg-warning-500 text-white text-[9px] px-1.5 py-0.5 rounded-full font-bold">8</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-accent-600 mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    <span class="text-xs font-semibold text-slate-700">Approvals</span>
                </a>
                <a href="<?= page_url('/reports') ?>" class="flex flex-col items-center justify-center p-3 border border-slate-200 rounded hover:bg-slate-50 text-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-accent-600 mb-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    <span class="text-xs font-semibold text-slate-700">Print Reports</span>
                </a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h2 class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-100">System Logs</h2>
            <div class="space-y-3.5">
                <div class="flex items-start gap-2.5 text-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent-500 mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p class="font-medium text-slate-700">Cedula issued to Maria Santos</p>
                        <p class="text-slate-400 text-2xs">10 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 text-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-success-500 mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p class="font-medium text-slate-700">Resident entry "Dela Cruz" updated</p>
                        <p class="text-slate-400 text-2xs">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 text-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-warning-500 mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p class="font-medium text-slate-700">New approval request: Barangay Clearance</p>
                        <p class="text-slate-400 text-2xs">4 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
