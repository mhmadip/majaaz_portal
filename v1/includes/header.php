<?php
require_once __DIR__ . "/../config.php";
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'بوابة مسابقة مجاز المعمارية ٢٠٢٦') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{ background:#f6f7fb; }
    .navbar-brand{ font-weight:700; }
    .card{ border-radius: 16px; }
    .badge-soft{ background:#eef2ff; color:#3730a3; }
    .mono{ font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/majaaz_portal/">مجاز ٢٠٢٦</a>
    <div class="ms-auto d-flex align-items-center gap-2">
      <?php if (!empty($_SESSION['user'])): ?>
        <span class="text-white-50 small">
          <?= e($_SESSION['user']['name']) ?> — <span class="badge badge-soft"><?= e($_SESSION['user']['role']) ?></span>
        </span>
        <a class="btn btn-sm btn-outline-light" href="/majaaz_portal/auth/logout.php">تسجيل الخروج</a>
      <?php else: ?>
        <a class="btn btn-sm btn-outline-light" href="/majaaz_portal/auth/login.php">تسجيل الدخول</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container py-4">
<?php $flash = flash_get(); if ($flash): ?>
  <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['msg']) ?></div>
<?php endif; ?>
