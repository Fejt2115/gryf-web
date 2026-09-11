<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

/*
 * Pobieramy najnowsze wpisy z bazy.
 * LIMIT 10 oznacza, że na stronie głównej pokażemy maksymalnie
 * 10 ostatnich postów.
 */
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

/*
 * Bezpieczne wyświetlanie tekstu.
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="k40ZYFeJNlwDKVAAJ7xA5Wi4xEBpvFXkCxhH2IJ3uUs">
    <meta name="description" content="Żeglarstwo to sztuka, przygoda i sens życia w jednym.">
    <meta name="keywords"
        content="Żeglarstwo, Zeglarstwo, Grudziadz, Grudziądz, Gryf, Gryfa, Towarzystwo, Żeglarzy, Zeglarzy">
    <meta name="robots" content="index, nofollow">
    <meta name="author" content="Michał Szołtyski">
    <meta property="og:title" content='Towarzystwo Żeglarskie "Gryf" w Grudziądzu'>
    <meta property="og:description" content="Żeglarstwo to sztuka, przygoda i sens życia w jednym.">
    <meta property="og:image" content="public/logo-gryf.png">
    <meta property="og:url" content="https://tzgryf.pl/">
    <title>Towarzystwo Żeglarskie "Gryf" w Grudziądzu</title>
    <link rel="icon" href="public/logo-gryf.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="public/logo-gryf.png">
    <link rel="canonical" href="https://tzgryf.pl/">
    <!-- Bootstrap 4.5.2 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #d2f4f7;
        }

        @media (max-width: 400px) {

            a.hide-on-small {
                display: none;
            }

        }

        @media (min-width: 580.20px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 2rem;
            }

            .card-img-top {
                width: 30rem;
            }

        }

        @media (min-width: 470px) and (max-device-width: 580px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 18px;
            }

            .card-img-top {
                width: 20rem;
            }

        }

        @media (min-width: 385px) and (max-device-width: 469.98px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 16px;
            }

            .card-img-top {
                width: 15rem;
            }

        }

        @media (min-width: 360px) and (max-device-width: 384.98px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 14px;
            }

            .card-img-top {
                width: 10rem;
            }

        }

        @media (min-width: 333px) and (max-device-width: 359.98px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 12px;
            }

            .card-img-top {
                width: 8rem;
            }

        }

        @media (min-width: 311px) and (max-device-width: 332.98px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 10px;
            }

            .card-img-top {
                width: 8rem;
            }

        }

        @media (min-width: 1px) and (max-device-width: 310.98px) {

            .navbar-brand-highlight {
                color: #007bff;
                font-weight: bold;
                font-size: 8px;
            }

            .card-img-top {
                width: 8rem;
            }

        }

        .carousel-inner {
            max-width: 100%;
            height: 300px;
        }

        .carousel-item img {
            position: relative;
            top: 50%;
            transform: translateY(-25%);
        }

        @media (max-width: 767px) {

            .carousel-inner {
                height: 100px;
            }

            .carousel-control-prev,
            .carousel-control-next {
                top: 50%;
                transform: translateY(-50%);
            }

        }

        @media (max-width: 1000px) and (min-width: 767.30px) {

            .carousel-inner {
                height: 200px;
            }

            .carousel-control-prev,
            .carousel-control-next {
                top: 50%;
                transform: translateY(-50%);
            }

        }

        @media (max-width: 1200px) and (min-width: 1000.30px) {

            .carousel-inner {
                height: 250px;
            }

            .carousel-control-prev,
            .carousel-control-next {
                top: 50%;
                transform: translateY(-50%);
            }

        }

        .card:not(:first-child) {
            margin-top: 1rem;
        }
    </style>

</head>

<body>
    <!-- =========================================================
     NAVBAR
    ========================================================= -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
        <div class="container">
            <a class="navbar-brand navbar-brand-highlight" href="index.php">
                <img src="public/logo-gryf.png" width="90" alt="Logo Towarzystwa Żeglarskiego Gryf"
                    class="d-lg-inline-block">
                Towarzystwo Żeglarskie
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active" href="index.php">
                            Strona główna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="onas.php">
                            O nas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aktualnosci.php">
                            Aktualności
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php">
                            Kontakt
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dopobrania.php">
                            Do pobrania
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- =========================================================
     KARUZELA
    ========================================================= -->
    <div class="container mt-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/assets/rudnik.jpg" class="d-block w-100" alt="Rudnik">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/puchary.jpg" class="d-block w-100" alt="Puchary">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/czwarta.jpg" class="d-block w-100" alt="Towarzystwo Żeglarskie Gryf">
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
    <!-- =========================================================
     STOPKA
    ========================================================= -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        Towarzystwo Żeglarskie "Gryf"
                    </p>
                    <p>
                        Adres: ul. Spacerowa 4, 86-300 Grudziądz
                    </p>
                </div>
                <div class="col-md-6 text-right">
                    <!-- FACEBOOK -->
                    <a href="https://www.facebook.com/profile.php?id=100084212346120" target="_blank"
                        rel="noopener noreferrer" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                        </svg>
                    </a>
                    |
                    <!-- WHATSAPP -->
                    <a href="#" aria-label="WhatsApp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                        </svg>
                    </a>
                    |
                    <!-- EMAIL -->
                    <a href="mailto:Tzgryf.grudziadz@wp.pl" aria-label="Email">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- =========================================================
     JAVASCRIPT
    ========================================================= -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>