CREATE TABLE IF NOT EXISTS posts (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    facebook_id   VARCHAR(255) NOT NULL UNIQUE,
    message       TEXT         NULL,
    image_url     VARCHAR(1024) NULL,
    published_at  DATETIME     NULL,
    facebook_url  VARCHAR(1024) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;