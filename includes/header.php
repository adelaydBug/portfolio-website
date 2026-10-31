<?php require_once __DIR__ . '/../config/db.php'; $pageTitle = $pageTitle ?? 'Adelaide Ternida | Portfolio'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="color-scheme" content="dark light">
<script>try{document.documentElement.dataset.theme=localStorage.getItem("theme")||"dark"}catch(e){document.documentElement.dataset.theme="dark"}</script>
<title><?= e($pageTitle) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;800&family=Inter:wght@400;500&family=Poppins:wght@700&display=swap">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
