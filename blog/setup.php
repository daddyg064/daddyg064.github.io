<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/partials/header.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter a username and password.';
    } else {
        try {
            $pdo = get_db_connection();
            $statement = $pdo->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
            $statement->execute(['username' => $username]);

            if ($statement->fetch()) {
                $error = 'That username already exists.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (:username, :hash)');
                $insert->execute([
                    'username' => $username,
                    'hash' => $hash,
                ]);
                $message = 'User created! You can now log in. Remember to delete setup.php after finishing.';
            }
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }
    }
}
?>
<section class="card auth-card">
    <h2>Initial setup</h2>
    <p>Create your first admin account.</p>

    <?php if ($error !== '') : ?>
        <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($message !== '') : ?>
        <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post" class="form">
        <label>
            Admin username
            <input type="text" name="username" required>
        </label>
        <label>
            Admin password
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="primary">Create admin</button>
    </form>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
