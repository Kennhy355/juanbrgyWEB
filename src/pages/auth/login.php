<?php
/**
 * Login Page
 */

$pageTitle = 'Login';
$contentFile = __FILE__;

// Handle form action (mock response)
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === 'admin' && $password === 'admin') {
        redirect(page_url('/'));
    } else {
        $error = 'Invalid username or password. Hint: use "admin" for both.';
    }
}

// If this file is executed directly (not included), wrap it with the template.
if (!isset($templateRendered)) {
    include __DIR__ . '/../../templates/auth.php';
    exit;
}
?>

<?php if ($error): ?>
    <div class="alert alert-danger">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span><?= e($error) ?></span>
    </div>
<?php endif; ?>

<form action="<?= page_url('/auth/login') ?>" method="POST" class="space-y-4">
    <div class="form-group">
        <label for="username" class="form-label form-label-required">Username</label>
        <input type="text" id="username" name="username" class="form-input" placeholder="e.g. admin" required autofocus value="<?= isset($_POST['username']) ? e($_POST['username']) : '' ?>">
    </div>

    <div class="form-group">
        <label for="password" class="form-label form-label-required">Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="e.g. admin" required>
    </div>

    <div class="flex items-center justify-between pt-1">
        <label class="inline-flex items-center gap-2 cursor-pointer select-none text-sm text-slate-600">
            <input type="checkbox" class="form-checkbox">
            Remember me
        </label>
        <a href="#" class="text-xs text-accent-600 hover:underline">Forgot password?</a>
    </div>

    <button type="submit" class="w-full btn btn-primary py-2.5 mt-2">
        Sign In
    </button>
</form>
