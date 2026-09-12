<?php
$source = __DIR__ . '/source.txt';
$target = __DIR__ . '/copy.txt';

if (!is_file($source)) {
    http_response_code(404);
    exit('Source file not found.');
}

if (!copy($source, $target)) {
    http_response_code(500);
    exit('Copy failed.');
}

echo 'File copied successfully';
?>
