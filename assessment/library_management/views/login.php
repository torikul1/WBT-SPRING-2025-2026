<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login &mdash; Library Management</title>
<!-- <link rel="stylesheet" href="style.css"> -->
<link rel="stylesheet" href="newstyle.css">
</head>
<body class="auth-body">

<div class="auth-shell">
    <div class="auth-side">
        <div class="logo-big">&#128218;</div>
        <h1>Pharmacy Management System</h1>
        <p>Manage Pharmacy. Sign in to access your dashboard.</p>
        <ul class="feature-list">
            <li>&#10003; Admin manages Vendors</li>
            <li>&#10003; Vendors manages medicine</li>
            <li>&#10003; Live AJAX search</li>
            <li>&#10003; Secure session login</li>
        </ul>
    </div>

    <div class="auth-form-wrap">
        <div class="auth-card">
            <h2>Welcome Back</h2>
            <p class="muted">Please sign in to continue</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?page=login" class="form" novalidate>
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                           value="<?= htmlspecialchars($prefill ?? '') ?>"
                           placeholder="Enter username" required autofocus>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Enter password" required>
                </div>
                <label class="checkbox">
                    <input type="checkbox" name="remember" <?= !empty($prefill) ? 'checked' : '' ?>>
                    <span>Remember me</span>
                </label>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>

            <p class="auth-foot">Don't have an account?
                <a href="index.php?page=register">Register as Vendors</a>
            </p>
            <p class="hint"><strong>Default Admin:</strong> admin / admin123</p>
        </div>
    </div>
</div>

</body>
</html>
