<?php
// One-time maintenance script: resize/recompress existing uploads/ images
// in place (same filenames, no DB changes). CLI-only. Delete after running.
if (php_sapi_name() !== 'cli') { http_response_code(403); exit; }

$dir = __DIR__ . '/uploads';
$maxDim = 1600;
$totalBefore = 0; $totalAfter = 0; $count = 0; $skipped = 0;

foreach (scandir($dir) as $f) {
  if ($f === '.' || $f === '..' || $f === '.htaccess') continue;
  $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
  if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) { $skipped++; continue; }

  $path = "$dir/$f";
  $before = filesize($path);
  $bin = file_get_contents($path);
  $img = @imagecreatefromstring($bin);
  if ($img === false) { echo "SKIP (invalid image): $f\n"; $skipped++; continue; }

  if (($ext === 'jpg' || $ext === 'jpeg') && function_exists('exif_read_data')) {
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

  $ok = match ($ext) {
    'jpg', 'jpeg' => imagejpeg($img, $path, 78),
    'png'  => imagepng($img, $path, 6),
    'webp' => imagewebp($img, $path, 78),
    default => false,
  };
  if (!$ok) { echo "FAIL to write: $f\n"; continue; }

  $after = filesize($path);
  $totalBefore += $before; $totalAfter += $after; $count++;
  printf("%-40s %8d -> %8d bytes (%.0f%%)\n", $f, $before, $after, $after / max(1,$before) * 100);
}

printf("\nDone. %d processed, %d skipped.\n", $count, $skipped);
printf("Total: %.1f MB -> %.1f MB (%.0f%% reduction)\n",
  $totalBefore / 1e6, $totalAfter / 1e6, (1 - $totalAfter / max(1,$totalBefore)) * 100);
