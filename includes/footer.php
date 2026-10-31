<?php $base = basename($_SERVER['PHP_SELF']) === 'index.php' ? '' : 'index.php'; ?>
<footer class="footer">
    <nav class="footer-links" aria-label="Footer">
        <a href="<?= $base ?>#home">Home</a>
        <a href="<?= $base ?>#about">About me</a>
        <a href="<?= $base ?>#projects">Projects</a>
        <a href="<?= $base ?>#contact">Send a Message</a>
        <a href="https://github.com/AdelaydBug">GitHub</a>
    </nav>
    <p>&copy; 2026 Adelaide Portfolio</p>
</footer>
<script src="assets/js/script.js"></script>
</body>
</html>