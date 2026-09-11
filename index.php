<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Towarzystwo Żeglarskie "Gryf" w Grudziądzu';
$pageDescription = 'Żeglarstwo to sztuka, przygoda i sens życia w jednym.';
$activePage = 'home';

$stmt = $pdo->query("
    SELECT
        id,
        facebook_id,
        message,
        image_url,
        published_at,
        facebook_url
    FROM posts
    ORDER BY published_at DESC, id DESC
    LIMIT 10
");

$posts = $stmt->fetchAll();

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

require __DIR__ . '/includes/header.php';
?>

    <!-- =========================================================
     KARUZELA
    ========================================================= -->
    <div class="container mt-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/assets/temp1.jpg" class="d-block w-100" alt="Rudnik">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/temp2.jpg" class="d-block w-100" alt="Puchary">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/temp3.jpg" class="d-block w-100" alt="Towarzystwo Żeglarskie Gryf">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    Poprzedni
                </span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    Następny
                </span>
            </a>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
        </div>
    </div>
    <!-- =========================================================
     LOGA SPONSORÓW - TELEFON
    ========================================================= -->
    <div class="container d-md-none mt-5">
        <div class="d-flex justify-content-center sponsor-logos-top">
            <a href="https://pya.org.pl/polski-zwiazek-zeglarski" target="_blank" rel="noopener noreferrer">
                <img src="public/PZZ_logo.jpeg" height="80" alt="Polski Związek Żeglarski" class="m-2">
            </a>
            <a href="http://tozz.org.pl/" target="_blank" rel="noopener noreferrer">
                <img src="public/tozz.png" height="80" alt="Toruński Okręgowy Związek Żeglarski" class="m-2">
            </a>
            <a href="https://grudziadz.pl/" target="_blank" rel="noopener noreferrer">
                <img src="public/herb.jpg" height="80" alt="Urząd Miejski w Grudziądzu" class="m-2">
            </a>
            <a href="https://kujawsko-pomorskie.pl/" target="_blank" rel="noopener noreferrer" class="hide-on-small">
                <img src="public/kujawsko.jpg" height="80" alt="Województwo Kujawsko-Pomorskie" class="m-2">
            </a>
        </div>
    </div>
    <!-- =========================================================
     GŁÓWNA TREŚĆ
    ========================================================= -->
    <div class="container mt-5">
        <div class="row">
            <!-- =====================================================
             POSTY
            ====================================================== -->
            <div class="col-md-10">
                <h2>
                    Artykuły z Facebooka
                </h2>
                <div class="facebook-articles">
                    <?php if (empty($posts)): ?>
                        <div class="card text-center">
                            <div class="card-body">
                                <p class="card-text">
                                    Brak aktualnych artykułów.
                                </p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <div class="card text-center">
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
                                            Odsyłacz do facebooka
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- =====================================================
             LOGA SPONSORÓW - DESKTOP
            ====================================================== -->
            <div class="col-md-2 order-md-2 d-none d-md-block">
                <h2 class="text-center">
                    <br>
                </h2>
                <div class="sponsor-logos">
                    <div class="text-center mb-5">
                        <a href="https://pya.org.pl/polski-zwiazek-zeglarski" target="_blank" rel="noopener noreferrer">
                            <img src="public/PZZ_logo.jpeg" width="120" alt="Polski Związek Żeglarski">
                        </a>
                    </div>
                    <div class="text-center mb-5">
                        <a href="http://tozz.org.pl/" target="_blank" rel="noopener noreferrer">
                            <img src="public/tozz.png" width="120" alt="Toruński Okręgowy Związek Żeglarski">
                        </a>
                    </div>
                    <div class="text-center mb-5">
                        <a href="https://grudziadz.pl/" target="_blank" rel="noopener noreferrer">
                            <img src="public/herb.jpg" width="120" alt="Urząd Miejski w Grudziądzu">
                        </a>
                    </div>
                    <div class="text-center mb-5">
                        <a href="https://kujawsko-pomorskie.pl/" target="_blank" rel="noopener noreferrer">
                            <img src="public/kujawsko.jpg" width="120" alt="Województwo Kujawsko-Pomorskie">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>