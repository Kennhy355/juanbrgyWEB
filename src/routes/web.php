<?php
/**
 * Router
 * 
 * Simple PHP router that maps URLs to page files.
 */

function get_base_path(): string
{
    $base = dirname($_SERVER['SCRIPT_NAME']);
    $base = str_replace('\\', '/', $base);
    return rtrim($base, '/');
}

/**
 * Get the current request URI path, relative to the base path.
 */
function get_route(): string
{
    $uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = get_base_path();

    // Strip the base path prefix so "/juanbrgyWEB/about" becomes "/about"
    if ($base && str_starts_with($uri, $base)) {
        $uri = substr($uri, strlen($base));
    }

    return rtrim($uri, '/') ?: '/';
}

/**
 * Define route-to-file mappings.
 */
function get_routes(): array
{
    return [
        // Auth
        '/auth/login'                   => __DIR__ . '/../pages/auth/login.php',
        '/auth/change-password'         => __DIR__ . '/../pages/auth/change_password.php',

        // Dashboard
        '/'                             => __DIR__ . '/../pages/dashboard.php',

        // Resident Management
        '/residents'                    => __DIR__ . '/../pages/residents/list.php',
        '/residents/create'             => __DIR__ . '/../pages/residents/form.php',
        '/residents/edit'               => __DIR__ . '/../pages/residents/form.php',
        '/residents/view'               => __DIR__ . '/../pages/residents/view.php',

        // Reports & Queries
        '/reports'                      => __DIR__ . '/../pages/reports/index.php',
        '/reports/custom'               => __DIR__ . '/../pages/reports/custom_list.php',
        '/reports/custom/create'        => __DIR__ . '/../pages/reports/custom_form.php',
        '/reports/custom/edit'          => __DIR__ . '/../pages/reports/custom_form.php',
        '/reports/adhoc'                => __DIR__ . '/../pages/reports/adhoc.php',

        // Approvals
        '/approvals/rules'              => __DIR__ . '/../pages/approvals/queue_rules.php',
        '/approvals/authorization'      => __DIR__ . '/../pages/approvals/authorization.php',

        // References (List & Form maps)
        '/references/barangay'          => __DIR__ . '/../pages/references/barangay_list.php',
        '/references/barangay/edit'     => __DIR__ . '/../pages/references/barangay_form.php',

        '/references/admin'             => __DIR__ . '/../pages/references/admin_list.php',
        '/references/admin/edit'        => __DIR__ . '/../pages/references/admin_form.php',

        '/references/cases'             => __DIR__ . '/../pages/references/cases_list.php',
        '/references/cases/edit'        => __DIR__ . '/../pages/references/cases_form.php',

        '/references/nationality'       => __DIR__ . '/../pages/references/nationality_list.php',
        '/references/nationality/edit'  => __DIR__ . '/../pages/references/nationality_form.php',

        '/references/municipality'      => __DIR__ . '/../pages/references/municipality_list.php',
        '/references/municipality/edit' => __DIR__ . '/../pages/references/municipality_form.php',

        '/references/state'             => __DIR__ . '/../pages/references/state_list.php',
        '/references/state/edit'        => __DIR__ . '/../pages/references/state_form.php',

        '/references/country'           => __DIR__ . '/../pages/references/country_list.php',
        '/references/country/edit'      => __DIR__ . '/../pages/references/country_form.php',

        '/references/religion'          => __DIR__ . '/../pages/references/religion_list.php',
        '/references/religion/edit'     => __DIR__ . '/../pages/references/religion_form.php',

        '/references/communication'      => __DIR__ . '/../pages/references/communication_list.php',
        '/references/communication/edit' => __DIR__ . '/../pages/references/communication_form.php',

        // System Settings
        '/system/users'                 => __DIR__ . '/../pages/system/users.php',
        '/system/users/edit'            => __DIR__ . '/../pages/system/user_form.php',
        '/system/roles'                 => __DIR__ . '/../pages/system/roles.php',
        '/system/roles/edit'            => __DIR__ . '/../pages/system/role_form.php',
        '/system/options'               => __DIR__ . '/../pages/system/options.php',
        '/system/todo'                  => __DIR__ . '/../pages/system/todo.php',
    ];
}

/**
 * Dispatch the current request to the appropriate page.
 */
function dispatch(): void
{
    $route  = get_route();
    $routes = get_routes();

    if (isset($routes[$route])) {
        require $routes[$route];
    } else {
        http_response_code(404);
        // Show styled 404
        $pageTitle = '404 - Page Not Found';
        $pageSubtitle = 'The requested page does not exist or has been moved.';
        $breadcrumbs = ['Error' => ''];
        
        $contentFile = __DIR__ . '/../pages/errors/404.php';
        // Make sure error page file exists or we render simple text
        if (!file_exists($contentFile)) {
            // Create a quick fallback content
            if (!is_dir(dirname($contentFile))) {
                mkdir(dirname($contentFile), 0777, true);
            }
            file_put_contents($contentFile, '
                <div class="bg-white border border-slate-200 rounded-lg p-8 text-center max-w-lg mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-slate-400 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="8" y1="15" x2="16" y2="15"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>
                    </svg>
                    <h2 class="text-lg font-bold text-slate-800 mb-2">Resource Not Found</h2>
                    <p class="text-slate-500 mb-6">We could not find the page you are looking for. Please check the URL or use the navigation sidebar.</p>
                    <a href="' . page_url('/') . '" class="btn btn-primary">Return to Dashboard</a>
                </div>
            ');
        }
        include __DIR__ . '/../templates/base.php';
    }
}
