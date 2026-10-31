<?php
require_once 'config/db.php';
$error = ''; $name = ''; $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $pass    = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    if (!$pdo)                                          $error = 'The database is not running. Start MySQL and try again.';
    elseif ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Enter your name and a valid email.';
    elseif (strlen($pass) < 8)                          $error = 'Use a password with at least 8 characters.';
    elseif ($pass !== $confirm)                         $error = 'The passwords do not match.';
    else {
        $st = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $st->execute([$email]);
        if ($st->fetch()) {
            $error = 'That email already has an account. Sign in instead.';
        } else {
            $st = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $st->execute([$name, $email, password_hash($pass, PASSWORD_DEFAULT)]);
            session_regenerate_id(true);
            $_SESSION['user'] = ['id' => $pdo->lastInsertId(), 'name' => $name];
            header('Location: index.php'); exit;
        }
    }
}
$pageTitle = 'Create account | Adelaide Ternida';
include 'includes/header.php'; include 'includes/navbar.php';
?>
<main class="container section narrow">
    <h1 class="page-title">Create account</h1>
    <?php if ($error): ?><p class="notice err" role="alert"><?= e($error) ?></p><?php endif; ?>
    <form class="card form" method="post" action="register.php">
        <label>Name<input type="text" name="name" required maxlength="100" value="<?= e($name) ?>"></label>
        <label>Email<input type="email" name="email" required maxlength="100" value="<?= e($email) ?>"></label>
        <label>Password<input type="password" name="password" required minlength="8"></label>
        <label>Confirm password<input type="password" name="confirm" required minlength="8"></label>
        <button class="btn" type="submit">Create account</button>
        <p>Already have an account? <a class="link" href="login.php">Sign in</a></p>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
