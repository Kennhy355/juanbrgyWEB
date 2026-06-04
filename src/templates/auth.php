<?php
$templateRendered = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Barangay Juan Management Information System - Portal">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' - ' : '' ?>Barangay Juan MIS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset_url('dist/css/app.css') ?>">
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col justify-between">

    <div class="flex-grow flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white border border-slate-200 rounded-lg shadow-sm p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gov-100 text-gov-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18"/>
                        <path d="M5 21V7l7-4 7 4v14"/>
                        <path d="M9 21v-6h6v6"/>
                        <path d="M9 9h.01"/><path d="M15 9h.01"/>
                        <path d="M9 13h.01"/><path d="M15 13h.01"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gov-700">Barangay Juan</h1>
                <p class="text-xs text-slate-500 mt-1">Management Information System</p>
            </div>

            <?php if (isset($contentFile) && file_exists($contentFile)): ?>
                <?php include $contentFile; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer class="text-center py-4 text-xs text-slate-400 border-t border-slate-200 bg-white">
        &copy; <?= date('Y') ?> Barangay Juan. All rights reserved.
    </footer>

</body>
</html>
