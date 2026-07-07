<?php

$user = current_user();
?>
<header class="topnav">
    <a href="<?= page_url('/') ?>" class="topnav-brand hover:opacity-80 transition-opacity">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 21h18"/>
            <path d="M5 21V7l7-4 7 4v14"/>
            <path d="M9 21v-6h6v6"/>
            <path d="M9 9h.01"/><path d="M15 9h.01"/>
            <path d="M9 13h.01"/><path d="M15 13h.01"/>
        </svg>
        <div>
            <div class="text-sm font-bold leading-tight">Barangay Juan</div>
            <div class="text-2xs opacity-70 font-normal">Management Information System</div>
        </div>
    </a>

    <div class="topnav-actions">
        <button class="topnav-btn" title="Notifications">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
            </svg>
            <span class="bg-danger-500 text-white text-2xs px-1.5 py-0.5 rounded-full leading-none">3</span>
        </button>
        <div class="flex items-center gap-2 pl-2 border-l border-gov-400">
            <div class="w-7 h-7 rounded-full bg-gov-400 flex items-center justify-center text-xs font-bold">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
            </div>
            <div class="hidden sm:block">
                <div class="text-xs font-medium leading-tight"><?= e($user['name']) ?></div>
                <div class="text-2xs opacity-70"><?= e($user['role']) ?></div>
            </div>
        </div>
        <a href="<?= page_url('/auth/login') ?>" class="topnav-btn text-xs" title="Logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </a>
    </div>
</header>
