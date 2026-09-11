<?php

declare(strict_types=1);

$activePage = $activePage ?? '';

function navItem(string $href, string $label, string $key): string
{
    $active = ($GLOBALS['activePage'] === $key) ? ' active' : '';
    return '<li class="nav-item' . $active . '">'
        . '<a class="nav-link' . $active . '" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($label, ENT_QUOTES, 'UTF-8')
        . '</a></li>';
}

$navItems = [
    ['index.php',       'Strona główna', 'home'],
    ['onas.php',        'O nas',         'onas'],
    ['aktualnosci.php',  'Aktualności',  'aktualnosci'],
    ['kontakt.php',      'Kontakt',      'kontakt'],
    ['dopobrania.php',   'Do pobrania',   'dopobrania'],
];

?>
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
                <?php foreach ($navItems as [$href, $label, $key]): ?>
                    <?= navItem($href, $label, $key) ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>