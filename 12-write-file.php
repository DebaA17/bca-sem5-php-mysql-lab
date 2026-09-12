<?php
$notesFile = __DIR__ . '/notes.txt';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $name = trim((string)($_POST['name'] ?? ''));
    $message = trim((string)($_POST['message'] ?? ''));

    if ($name === '' || $message === '') {
        echo 'Name and message are required.';
        exit;
    }

    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    $data = date('Y-m-d H:i:s') . " | Name: {$safeName} | Message: {$safeMessage}\n";

    if (file_put_contents($notesFile, $data, FILE_APPEND | LOCK_EX) === false) {
        http_response_code(500);
        exit('Could not save file.');
    }

    echo 'Saved to notes.txt';
} else {
    echo '<form method="post">
        Name: <input type="text" name="name" required><br>
        Message: <textarea name="message" required></textarea><br>
        <input type="submit" value="Save">
    </form>';
}
?>
