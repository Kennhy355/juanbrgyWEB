<?php



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


function page_url(string $path = '/'): string
{
    return base_url(ltrim($path, '/'));
}


function asset_url(string $path): string
{
    return base_url($path);
}


function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


function is_active(string $path): bool
{
    $current = get_route();
    if ($path === '/') return $current === '/';
    return $current === $path || str_starts_with($current, $path . '/');
}


function active_class(string $path): string
{
    return is_active($path) ? 'active' : '';
}


function redirect(string $url, int $code = 302): void
{
    http_response_code($code);
    header("Location: $url");
    exit;
}


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
