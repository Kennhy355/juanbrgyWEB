<?php
/**
 * Utility Helpers
 */

/**
 * Get the base URL path for the application (handles subdirectory installs).
 */
function base_url(string $path = ''): string
{
    static $base = null;
    if ($base === null) {
        $base = dirname($_SERVER['SCRIPT_NAME']);
        $base = str_replace('\\', '/', $base);
        $base = rtrim($base, '/');
    }
    $path = ltrim($path, '/');
    return $base . '/' . $path;
}

/**
 * Generate a page URL.
 */
function page_url(string $path = '/'): string
{
    return base_url(ltrim($path, '/'));
}

/**
 * Generate an asset URL.
 */
function asset_url(string $path): string
{
    return base_url($path);
}

/**
 * Escape output for HTML context.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Check if the current route matches (or starts with) the given path.
 */
function is_active(string $path): bool
{
    $current = get_route();
    if ($path === '/') return $current === '/';
    return $current === $path || str_starts_with($current, $path . '/');
}

/**
 * Return an "active" CSS class if the route matches.
 */
function active_class(string $path): string
{
    return is_active($path) ? 'active' : '';
}

/**
 * Redirect to a given URL.
 */
function redirect(string $url, int $code = 302): void
{
    http_response_code($code);
    header("Location: $url");
    exit;
}

/**
 * Get mock current user data.
 */
function current_user(): array
{
    return [
        'id'       => 1,
        'username' => 'admin',
        'name'     => 'Juan Dela Cruz',
        'role'     => 'Administrator',
        'email'    => 'admin@juanbrgy.gov.ph',
    ];
}
