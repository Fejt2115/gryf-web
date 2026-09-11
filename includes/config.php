<?php

declare(strict_types=1);

$envFile = __DIR__ . '/../.env';

if (!file_exists($envFile)) {
    die('Brak pliku .env');
}

$env = parse_ini_file($envFile);

if ($env === false) {
    die('Nie można odczytać pliku .env');
}

$dbHost = $env['DB_HOST'] ?? '';
$dbName = $env['DB_NAME'] ?? '';
$dbUser = $env['DB_USER'] ?? '';
$dbPass = $env['DB_PASS'] ?? '';

try {
    $pdo = new PDO(
        "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die('Błąd połączenia z bazą danych.');
}