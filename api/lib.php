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

  $imgs = $pdo->query(
    "SELECT * FROM project_images WHERE is_cover=0 ORDER BY file_path ASC, id ASC"
  )->fetchAll();
  $imgByProject = [];
  foreach ($imgs as $im) {
    $pid = (int)$im['project_id'];
    $imgByProject[$pid][] = [
      "dataUrl"   => "/majaaz_portal/" . $im['file_path'],
      "filename"  => pathinfo($im['file_path'], PATHINFO_BASENAME),
      "desc"      => $im['description'] ?? ""
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
  $rows  = $pdo->query("SELECT id,name,email,role,password_plain,created_at FROM users ORDER BY id DESC")->fetchAll();
  $users = [];
  foreach ($rows as $u) {
    $users[] = [
      "id"        => "u" . (int)$u['id'],
      "email"     => $u['email'],
      "role"      => $u['role'],
      "name"      => $u['name'],
      "password"  => $u['password_plain'] ?? '',
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

  // 5. Determine extension
  $fmt = strtolower($m[1]);
  $ext = ($fmt === 'jpeg' || $fmt === 'jpg') ? 'jpg' : $fmt;

  // 6. Correct orientation from EXIF before resizing (GD ignores it otherwise,
  //    which would leave phone-camera photos rotated after re-encoding)
  if ($ext === 'jpg' && function_exists('exif_read_data')) {
    $stream = fopen('php://temp', 'r+');
    fwrite($stream, $bin);
    rewind($stream);
    $exif = @exif_read_data($stream);
    fclose($stream);
    $orientation = (int)($exif['Orientation'] ?? 0);
    if ($orientation === 3) $img = imagerotate($img, 180, 0);
    elseif ($orientation === 6) $img = imagerotate($img, -90, 0);
    elseif ($orientation === 8) $img = imagerotate($img, 90, 0);
  }

  // 7. Downscale large images — the UI only ever displays these as thumbnails
  //    or in a lightbox, never at original resolution
  $maxDim = 1600;
  $w = imagesx($img); $h = imagesy($img);
  if ($w > $maxDim || $h > $maxDim) {
    $scale = min($maxDim / $w, $maxDim / $h);
    $nw = max(1, (int)round($w * $scale));
    $nh = max(1, (int)round($h * $scale));
    $resized = imagecreatetruecolor($nw, $nh);
    imagealphablending($resized, false);
    imagesavealpha($resized, true);
    imagecopyresampled($resized, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
    $img = $resized;
  }

  // 8. Write to disk with a random filename (no user-controlled path),
  //    re-encoding to shrink file size regardless of whether it was resized
  $name = bin2hex(random_bytes(12)) . "." . $ext;
  $rel  = $uploadDirRel . "/" . $name;
  $abs  = __DIR__ . "/../" . $rel;

  $ok = match ($ext) {
    'jpg'  => imagejpeg($img, $abs, 78),
    'png'  => imagepng($img, $abs, 6),
    'webp' => imagewebp($img, $abs, 78),
    default => false,
  };
  if (!$ok) {
    throw new Exception("Cannot write image file");
  }

  return [$rel, $ext];
}
