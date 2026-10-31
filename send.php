<?php
require_once 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php#contact'); exit; }

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$pdo) {
    header('Location: index.php?error=1#contact'); exit;
}
try {
    $stmt = $pdo->prepare('INSERT INTO messages (name, email, message) VALUES (?, ?, ?)');
    $stmt->execute([$name, $email, $message]);
    header('Location: index.php?sent=1#contact');
} catch (PDOException $e) {
    header('Location: index.php?error=1#contact');
}
exit;
