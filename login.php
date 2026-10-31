<?php
require_once 'config/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    $user  = null;
    if ($pdo) {
        $st = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $st->execute([$email]);
        $user = $st->fetch();
    }
    if ($user && password_verify($pass, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name']];
        header('Location: index.php'); exit;
    }
    $error = 'Wrong email or password. Check both and try again.';
}
$pageTitle = 'Sign in | Adelaide Ternida';
include 'includes/header.php'; include 'includes/navbar.php';
?>
<main class="container section narrow">
    <h1 class="page-title">Sign in</h1>
    <?php if ($error): ?><p class="notice err" role="alert"><?= e($error) ?></p><?php endif; ?>
    <form class="card form" method="post" action="login.php">
        <label>Email<input type="email" name="email" required maxlength="100" value="<?= e($_POST['email'] ?? '') ?>"></label>
        <label>Password<input type="password" name="password" required></label>
        <button class="btn" type="submit">Sign in</button>
        <p>No account yet? <a class="link" href="register.php">Create one</a></p>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
