<?php
function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception('.env file not found');
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !getenv($name)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Load .env file
try {
    loadEnv(__DIR__ . '/../.env');

    // Debugging: Verify environment variables
    echo 'MYSQL_HOST: ' . getenv('MYSQL_HOST') . PHP_EOL;
    echo 'MYSQL_USER: ' . getenv('MYSQL_USER') . PHP_EOL;
    echo 'MYSQL_PASSWORD: ' . getenv('MYSQL_PASSWORD') . PHP_EOL;
    echo 'MYSQL_DATABASE: ' . getenv('MYSQL_DATABASE') . PHP_EOL;
} catch (Exception $e) {
    die($e->getMessage());
}
?>