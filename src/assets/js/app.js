

document.addEventListener('DOMContentLoaded', () => {
    console.log('juanbrgyWEB loaded.');

    // ── Sidebar collapsible sections ──
    document.querySelectorAll('.sidebar-toggle').forEach(btn => {
        const linksGroup = btn.nextElementSibling;
        if (!linksGroup || !linksGroup.classList.contains('sidebar-links-group')) return;

        // Toggle on click
        btn.addEventListener('click', () => {
            const isExpanded = btn.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                linksGroup.classList.add('collapsed');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                linksGroup.classList.remove('collapsed');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });
});
