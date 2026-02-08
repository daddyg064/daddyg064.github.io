<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/partials/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter both a username and password.';
    } else {
        try {
            $pdo = get_db_connection();
            $statement = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :username LIMIT 1');
            $statement->execute(['username' => $username]);
            $user = $statement->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                header('Location: dashboard.php');
                exit;
            }

            $error = 'Invalid credentials. Please try again.';
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }
    }
}
?>
<section class="card auth-card">
    <h2>Log in</h2>
    <p>Access your dashboard to publish a new post.</p>

    <?php if ($error !== '') : ?>
        <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" class="form">
        <label>
            Username
            <input type="text" name="username" autocomplete="username" required>
        </label>
        <label>
            Password
            <input type="password" name="password" autocomplete="current-password" required>
        </label>
        <button type="submit" class="primary">Log in</button>
    </form>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
