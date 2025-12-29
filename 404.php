<?php
http_response_code(404);
?>
<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 — Сторінку не знайдено</title>
  <style>
    body{font-family:Arial, sans-serif;background:#f5f7fb;margin:0;display:flex;min-height:100vh;align-items:center;justify-content:center;}
    .card{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:28px;max-width:560px;width:92%;box-shadow:0 10px 25px rgba(0,0,0,.06);}
    h1{margin:0 0 10px;font-size:42px;}
    p{margin:8px 0;color:#374151;line-height:1.5;}
    a{display:inline-block;margin-top:14px;text-decoration:none;padding:10px 14px;border-radius:10px;border:1px solid #e5e7eb;}
  </style>
</head>
<body>
  <div class="card">
    <h1>404</h1>
    <p>На жаль, такої сторінки не існує або її було переміщено.</p>
    <p><b>URL:</b> <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') ?></p>
    <a href="/">Повернутися на головну</a>
  </div>
</body>
</html>
