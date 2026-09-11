<?php

declare(strict_types=1);

/**
 * Współdzielona sekcja <head> oraz otwarcie strony.
 *
 * Dostępne zmienne:
 *   $pageTitle       (string)  Tytuł strony (fallback: nazwa towarzystwa)
 *   $pageDescription (string)  Meta description (fallback: domyślny slogan)
 *   $canonical       (string)  Pełny URL kanoniczny (fallback: https://tzgryf.pl/)
 */

$pageTitle = $pageTitle ?? 'Towarzystwo Żeglarskie "Gryf" w Grudziądzu';
$pageDescription = $pageDescription ?? 'Żeglarstwo to sztuka, przygoda i sens życia w jednym.';
$canonical = $canonical ?? 'https://tzgryf.pl/';

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="k40ZYFeJNlwDKVAAJ7xA5Wi4xEBpvFXkCxhH2IJ3uUs">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="keywords"
        content="Żeglarstwo, Zeglarstwo, Grudziadz, Grudziądz, Gryf, Gryfa, Towarzystwo, Żeglarzy, Zeglarzy">
    <meta name="robots" content="index, nofollow">
    <meta name="author" content="Michał Szołtyski">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="public/logo-gryf.png">
    <meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" href="public/logo-gryf.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="public/logo-gryf.png">
    <link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
    <!-- Bootstrap 4.5.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
$activePage = $activePage ?? '';
require __DIR__ . '/navbar.php';
?>