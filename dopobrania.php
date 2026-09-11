<?php

declare(strict_types=1);

$pageTitle = 'Do pobrania - Towarzystwo Żeglarskie "Gryf"';
$pageDescription = 'Pliki do pobrania: formularze, regulaminy i dokumenty Towarzystwa Żeglarskiego "Gryf".';
$activePage = 'dopobrania';

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$uploadsDir = __DIR__ . '/uploads';
$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'odt', 'ods', 'png', 'jpg', 'jpeg', 'gif'];
$files = [];

if (is_dir($uploadsDir)) {
    foreach (scandir($uploadsDir) as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $filePath = $uploadsDir . '/' . $entry;
        if (!is_file($filePath)) {
            continue;
        }
        $ext = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions, true)) {
            continue;
        }
        $files[] = [
            'name' => $entry,
            'size' => filesize($filePath),
        ];
    }
}

usort($files, fn(array $a, array $b): int => strcmp($a['name'], $b['name']));

function formatSize(int $bytes): string
{
    if ($bytes >= 1_048_576) {
        return round($bytes / 1_048_576, 2) . ' MB';
    }
    if ($bytes >= 1024) {
        return round($bytes / 1024, 1) . ' KB';
    }
    return $bytes . ' B';
}

require __DIR__ . '/includes/header.php';
?>

    <div class="container mt-5">
        <h1 class="mb-4">Do pobrania</h1>

        <?php if (empty($files)): ?>
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">
                        Na chwilę obecną brak plików do pobrania.
                    </p>
                </div>
            </div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nazwa pliku</th>
                        <th scope="col" class="text-right">Rozmiar</th>
                        <th scope="col" class="text-right">Pobierz</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?= e($file['name']) ?></td>
                            <td class="text-right text-muted"><?= formatSize($file['size']) ?></td>
                            <td class="text-right">
                                <a href="uploads/<?= e($file['name']) ?>" class="btn btn-sm btn-primary"
                                   download="<?= e($file['name']) ?>">
                                    Pobierz
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>