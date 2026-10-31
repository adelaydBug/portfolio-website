<?php
$onHome = basename($_SERVER['PHP_SELF']) === 'index.php';
$links  = ['home'=>'Home','about'=>'About','projects'=>'Projects','contact'=>'Send a Message'];
$base   = $onHome ? '' : 'index.php';
?>
<header class="nav-wrap">
<nav class="nav container" aria-label="Main">
    <a class="brand" href="<?= $base ?>#home">Adelaide Ternida</a>
    <button class="nav-toggle" aria-expanded="false" aria-controls="menu">Menu</button>
    <ul id="menu" class="menu">
        <?php foreach ($links as $id => $label): ?>
        <li><a href="<?= $base ?>#<?= $id ?>"><?= $label ?></a></li>
        <?php endforeach; ?>
        <li><button class="theme-toggle" type="button" aria-label="Switch to light theme">
            <svg class="sun" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
            <svg class="moon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
        </button></li>
        <?php if (isset($_SESSION['user'])): ?>
        <li class="user">Hi, <?= e($_SESSION['user']['name']) ?></li>
        <li><a href="logout.php">Sign out</a></li>
        <?php else: ?>
        <li><a class="signin" href="login.php">Sign in</a></li>
        <?php endif; ?>
    </ul>
</nav>
</header>
