<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/partials/header.php';

$posts = [];
$db_error = '';

try {
    $pdo = get_db_connection();
    $statement = $pdo->query('SELECT id, title, body, created_at FROM posts ORDER BY created_at DESC');
    $posts = $statement->fetchAll();
} catch (RuntimeException $exception) {
    $db_error = $exception->getMessage();
}
?>
<section class="hero">
    <div>
        <h2>Welcome back</h2>
        <p>Share updates with the world in a clean, Facebook-inspired layout.</p>
    </div>
</section>

<section class="feed">
    <?php if ($db_error !== '') : ?>
        <div class="card empty-state">
            <h3>Database not connected</h3>
            <p><?php echo htmlspecialchars($db_error); ?> Update <code>config.php</code> and import <code>schema.sql</code>.</p>
        </div>
    <?php endif; ?>

    <?php if (empty($posts)) : ?>
        <div class="card empty-state">
            <h3>No posts yet</h3>
            <p>Log in to your dashboard to create your first post.</p>
        </div>
    <?php endif; ?>

    <?php foreach ($posts as $post) : ?>
        <article class="card post">
            <header>
                <div>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p class="meta">Published <?php echo htmlspecialchars(date('F j, Y', strtotime($post['created_at']))); ?></p>
                </div>
            </header>
            <p><?php echo nl2br(htmlspecialchars($post['body'])); ?></p>
        </article>
    <?php endforeach; ?>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
