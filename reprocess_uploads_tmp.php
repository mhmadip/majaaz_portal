<?php
// One-time maintenance script: resize/recompress existing uploads/ images
// in place (same filenames, no DB changes), matching save_data_url_image()
// in api/lib.php (maxDim=3600, quality=85, keep-original-if-smaller
// safeguard). CLI-only. Delete after running.
if (php_sapi_name() !== 'cli') { http_response_code(403); exit; }

$dir = __DIR__ . '/uploads';
$maxDim = 3600;
$totalBefore = 0; $totalAfter = 0; $count = 0; $kept = 0; $skipped = 0;

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
  $wasResized = $w > $maxDim || $h > $maxDim;
  if ($wasResized) {
    $scale = min($maxDim / $w, $maxDim / $h);
    $nw = max(1, (int)round($w * $scale));
    $nh = max(1, (int)round($h * $scale));
    $resized = imagecreatetruecolor($nw, $nh);
    imagealphablending($resized, false);
    imagesavealpha($resized, true);
    imagecopyresampled($resized, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
    $img = $resized;
  }

  ob_start();
  $ok = match ($ext) {
    'jpg', 'jpeg' => imagejpeg($img, null, 85),
    'png'  => imagepng($img, null, 6),
    'webp' => imagewebp($img, null, 85),
    default => false,
  };
  $encoded = ob_get_clean();
  if (!$ok || $encoded === false || $encoded === '') { echo "FAIL to encode: $f\n"; continue; }

  $final = (!$wasResized && strlen($encoded) >= strlen($bin)) ? $bin : $encoded;
  $usedOriginal = $final === $bin;
  if ($usedOriginal) $kept++;

  if (file_put_contents($path, $final) === false) { echo "FAIL to write: $f\n"; continue; }

  $after = filesize($path);
  $totalBefore += $before; $totalAfter += $after; $count++;
  printf("%-40s %8d -> %8d bytes (%.0f%%) %s\n", $f, $before, $after, $after / max(1,$before) * 100, $usedOriginal ? '[kept original]' : ($wasResized ? '[resized]' : '[recompressed]'));
}

printf("\nDone. %d processed (%d kept original untouched), %d skipped.\n", $count, $kept, $skipped);
printf("Total: %.1f MB -> %.1f MB (%.0f%% reduction)\n",
  $totalBefore / 1e6, $totalAfter / 1e6, (1 - $totalAfter / max(1,$totalBefore)) * 100);
