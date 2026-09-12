<?php
$file = __DIR__ . '/sample.txt';

if (!is_file($file)) {
    http_response_code(404);
    exit('File not found.');
}

$content = file_get_contents($file);
if ($content === false) {
    exit('Unable to read file.');
}

echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
?>
