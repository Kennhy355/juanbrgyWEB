<?php
$templateRendered = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Barangay Juan Management Information System">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' - ' : '' ?>Barangay Juan MIS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset_url('dist/css/app.css') ?>">
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col">

    <!-- Top Navigation -->
    <?php include __DIR__ . '/../components/header.php'; ?>

    <!-- Left Sidebar -->
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <!-- Main Content Area -->
    <main class="main-content flex flex-col justify-between">
        <div class="flex-grow">
            <!-- Breadcrumbs / Page Header -->
            <div class="mb-4">
                <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
                    <nav class="breadcrumb">
                        <a href="<?= page_url('/') ?>">Dashboard</a>
                        <?php foreach ($breadcrumbs as $label => $url): ?>
                            <span class="breadcrumb-sep">&gt;</span>
                            <?php if ($url): ?>
                                <a href="<?= page_url($url) ?>"><?= e($label) ?></a>
                            <?php else: ?>
                                <span class="text-slate-700 font-medium"><?= e($label) ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>
                <?php endif; ?>

                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?= isset($pageTitle) ? e($pageTitle) : 'Barangay Dashboard' ?></h1>
                        <?php if (isset($pageSubtitle)): ?>
                            <p class="page-subtitle"><?= e($pageSubtitle) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($headerActions)): ?>
                        <div class="flex items-center gap-2">
                            <?= $headerActions ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Page Specific Content -->
            <?php if (isset($contentFile) && file_exists($contentFile)): ?>
                <?php include $contentFile; ?>
            <?php else: ?>
                <div class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    <span>Page content file not found.</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </main>

    <script src="<?= asset_url('src/assets/js/app.js') ?>" defer></script>
</body>
</html>
