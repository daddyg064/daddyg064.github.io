<?php
require_once __DIR__ . '/auth.php';
require_login();
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/partials/header.php';

$title = '';
$body = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');

    if ($title === '' || $body === '') {
        $error = 'Please fill in both the title and body.';
    } else {
        try {
            $pdo = get_db_connection();
            $statement = $pdo->prepare('INSERT INTO posts (title, body, created_at) VALUES (:title, :body, NOW())');
            $statement->execute([
                'title' => $title,
                'body' => $body,
            ]);
            $success = 'Post created successfully!';
            $title = '';
            $body = '';
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }
    }
}
?>
<section class="card">
    <h2>Create a new post</h2>
    <p>Share your latest update with your readers.</p>

    <?php if ($error !== '') : ?>
        <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success !== '') : ?>
        <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="post" class="form">
        <label>
            Title
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
        </label>
        <label>
            Body
            <textarea name="body" rows="8" required><?php echo htmlspecialchars($body); ?></textarea>
        </label>
        <button type="submit" class="primary">Publish</button>
    </form>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
