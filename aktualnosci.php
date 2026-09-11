<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Aktualności - Towarzystwo Żeglarskie "Gryf"';
$pageDescription = 'Najnowsze wiadomości i wydarzenia Towarzystwa Żeglarskiego "Gryf" w Grudziądzu.';
$activePage = 'aktualnosci';

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$perPage = 10;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

$countStmt = $pdo->query("SELECT COUNT(*) FROM posts");
$totalPosts = (int)$countStmt->fetchColumn();
$totalPages = max(1, (int)ceil($totalPosts / $perPage));

$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare("
    SELECT id, facebook_id, message, image_url, published_at, facebook_url
    FROM posts
    ORDER BY published_at DESC, id DESC
    LIMIT :limit OFFSET :offset
");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

require __DIR__ . '/includes/header.php';
?>

    <div class="container mt-5">
        <h1 class="mb-4">Aktualności</h1>

        <?php if (empty($posts)): ?>
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">Brak aktualnych artykułów.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="card text-center mb-4">
                    <?php if (!empty($post['image_url'])): ?>
                        <img src="<?= e($post['image_url']) ?>" class="card-img-top" alt="" style="margin: auto;">
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if (!empty($post['message'])): ?>
                            <p class="card-text" style="white-space: pre-line;">
                                <?= e($post['message']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($post['published_at'])): ?>
                            <p class="card-footer text-body-secondary">
                                <small class="text-muted">
                                    Data przesłania:
                                    <?= e(date('Y-m-d', strtotime($post['published_at']))) ?>
                                </small>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($post['facebook_url'])): ?>
                            <a href="<?= e($post['facebook_url']) ?>" class="btn btn-primary" target="_blank"
                                rel="noopener noreferrer">
                                Odsyłacz do Facebooka
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($totalPages > 1): ?>
            <nav aria-label="Paginacja" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Poprzednia</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Następna</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>