<?php
require_once __DIR__ . "/../config.php";

/* ══ PROJECT DATA ══ */
function api_projects(PDO $pdo): array {
  $projects = $pdo->query("
    SELECT p.*,
      (SELECT file_path FROM project_images WHERE project_id=p.id AND is_cover=1 LIMIT 1) AS cover
    FROM projects p
    ORDER BY p.id DESC
  ")->fetchAll();

  $imgs = $pdo->query("SELECT * FROM project_images ORDER BY id DESC")->fetchAll();
  $imgByProject = [];
  foreach ($imgs as $im) {
    $pid = (int)$im['project_id'];
    $imgByProject[$pid][] = [
      "dataUrl" => "/majaaz_portal/" . $im['file_path'],
      "desc"    => $im['description'] ?? ""
    ];
  }

  $out = [];
  foreach ($projects as $p) {
    $pid    = (int)$p['id'];
    $out[] = [
      "id"        => "p" . $pid,
      "name"      => $p['name'],
      "cover"     => $p['cover'] ? "/majaaz_portal/" . $p['cover'] : null,
      "images"    => $imgByProject[$pid] ?? [],
      "createdAt" => strtotime($p['created_at']) * 1000
    ];
  }
  return $out;
}

/* ══ USER DATA (admin only) ══ */
function api_users_for_admin(PDO $pdo): array {
  $rows  = $pdo->query("SELECT id,name,email,role,created_at FROM users ORDER BY id DESC")->fetchAll();
  $users = [];
  foreach ($rows as $u) {
    $users[] = [
      "id"        => "u" . (int)$u['id'],
      "email"     => $u['email'],
      "role"      => $u['role'],
      "name"      => $u['name'],
      "createdAt" => strtotime($u['created_at']) * 1000
    ];
  }
  return $users;
}

/* ══ IMAGE SAVE — with server-side size enforcement ══ */
function save_data_url_image(string $dataUrl, string $uploadDirRel = "uploads"): array {
  // 1. Validate data URL format
  if (!preg_match('#^data:image/(png|jpeg|jpg|webp);base64,#i', $dataUrl, $m)) {
    throw new Exception("Invalid image data URL");
  }

  // 2. Decode base64
  $b64 = preg_replace('#^data:image/[^;]+;base64,#i', '', $dataUrl);
  $bin = base64_decode($b64, true);
  if ($bin === false) {
    throw new Exception("Bad base64 encoding");
  }

  // 3. SERVER-SIDE size check — max 4 MB (frontend allows 1 MB; this is the hard server limit)
  $maxBytes = 4 * 1024 * 1024;
  if (strlen($bin) > $maxBytes) {
    throw new Exception("Image exceeds maximum allowed size (4 MB)");
  }

  // 4. Validate it is actually an image using GD (prevents polyglot attacks)
  $img = @imagecreatefromstring($bin);
  if ($img === false) {
    throw new Exception("File is not a valid image");
  }
  imagedestroy($img);

  // 5. Determine extension
  $fmt = strtolower($m[1]);
  $ext = ($fmt === 'jpeg' || $fmt === 'jpg') ? 'jpg' : $fmt;

  // 6. Write to disk with a random filename (no user-controlled path)
  $name = bin2hex(random_bytes(12)) . "." . $ext;
  $rel  = $uploadDirRel . "/" . $name;
  $abs  = __DIR__ . "/../" . $rel;

  if (file_put_contents($abs, $bin) === false) {
    throw new Exception("Cannot write image file");
  }

  return [$rel, $ext];
}
