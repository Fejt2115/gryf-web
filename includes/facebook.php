<?php

/**
 * Skrypt pobierający posty z fanpage'a Facebooka via Graph API.
 *
 * Uruchamiany ręcznie lub przez cron (np. co 6h):
 *   php /path/to/includes/facebook.php
 *
 * Wymaga zmiennych w .env:
 *   PAGE_ID, PAGE_ACCESS_TOKEN
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';

$pageId = trim(getenv('PAGE_ID') ?: ($env['PAGE_ID'] ?? ''));
$pageAccessToken = trim(getenv('PAGE_ACCESS_TOKEN') ?: ($env['PAGE_ACCESS_TOKEN'] ?? ''));

if ($pageId === '' || $pageAccessToken === '') {
    fwrite(STDERR, "Brak PAGE_ID lub PAGE_ACCESS_TOKEN w .env\n");
    exit(1);
}

$graphUrl = sprintf(
    'https://graph.facebook.com/v21.0/%s/posts?fields=message,full_picture,created_time,permalink_url&limit=25&access_token=%s',
    urlencode($pageId),
    urlencode($pageAccessToken)
);

$ch = curl_init($graphUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => true,
]);
$raw = curl_exec($ch);

if (curl_errno($ch)) {
    fwrite(STDERR, "cURL error: " . curl_error($ch) . "\n");
    curl_close($ch);
    exit(1);
}

curl_close($ch);

$data = json_decode($raw, true);

if (!is_array($data) || !isset($data['data'])) {
    fwrite(STDERR, "Nieprawidłowa odpowiedź z Graph API:\n{$raw}\n");
    exit(1);
}

$insertStmt = $pdo->prepare("
    INSERT INTO posts (facebook_id, message, image_url, published_at, facebook_url)
    VALUES (:facebook_id, :message, :image_url, :published_at, :facebook_url)
    ON DUPLICATE KEY UPDATE
        message      = VALUES(message),
        image_url    = VALUES(image_url),
        published_at = VALUES(published_at),
        facebook_url = VALUES(facebook_url)
");

$count = 0;

foreach ($data['data'] as $post) {
    $facebookId   = $post['id'] ?? '';
    $message      = $post['message'] ?? null;
    $imageUrl     = $post['full_picture'] ?? null;
    $createdTime  = $post['created_time'] ?? null;
    $permalinkUrl = $post['permalink_url'] ?? null;

    if ($facebookId === '') {
        continue;
    }

    if ($createdTime !== null) {
        $dt = new DateTime($createdTime, new DateTimeZone('UTC'));
        $dt->setTimezone(new DateTimeZone('Europe/Warsaw'));
        $publishedAt = $dt->format('Y-m-d H:i:s');
    } else {
        $publishedAt = null;
    }

    $insertStmt->execute([
        ':facebook_id'   => $facebookId,
        ':message'       => $message,
        ':image_url'     => $imageUrl,
        ':published_at'  => $publishedAt,
        ':facebook_url'  => $permalinkUrl,
    ]);

    $count++;
}

echo "Pobrano i zapisano {$count} postów.\n";