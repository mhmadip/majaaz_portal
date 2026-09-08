<?php
require_once __DIR__ . "/lib.php";
require_csrf();
require_admin();
$data = read_json();
$pidStr = (string)($data['projectId'] ?? '');
$pid = 0;
if (preg_match('/^p(\d+)$/', $pidStr, $m)) $pid = (int)$m[1];
else $pid = (int)$pidStr;
if ($pid <= 0) json_out(["ok"=>false,"error"=>"Invalid projectId"], 400);
$name = trim((string)($data['name'] ?? ''));
if ($name === '') json_out(["ok"=>false,"error"=>"Name required"], 400);
$cover = (string)($data['cover'] ?? '');
$images = $data['images'] ?? [];
if (!is_array($images)) $images = [];
$pdo->beginTransaction();
try {
  $pdo->prepare("UPDATE projects SET name=? WHERE id=?")->execute([$name, $pid]);
  // Delete existing images
  $pdo->prepare("DELETE FROM project_images WHERE project_id=?")->execute([$pid]);
  // Save new cover
  if ($cover !== '' && str_starts_with($cover, 'data:')) {
    [$relPath, $_] = save_data_url_image($cover);
    $pdo->prepare("INSERT INTO project_images (project_id, file_path, description, is_cover) VALUES (?,?,?,1)")
        ->execute([$pid, $relPath, null]);
  } elseif ($cover !== '' && !str_starts_with($cover, 'data:')) {
    // Existing server path — re-insert as cover record
    $filePath = ltrim(str_replace('/majaaz_portal/', '', $cover), '/');
    $pdo->prepare("INSERT INTO project_images (project_id, file_path, description, is_cover) VALUES (?,?,?,1)")
        ->execute([$pid, $filePath, null]);
  }
  // Save other images
  foreach ($images as $im) {
    if (!is_array($im)) continue;
    $du = (string)($im['dataUrl'] ?? '');
    if ($du === '') continue;
    $desc = trim((string)($im['desc'] ?? ''));
    if (str_starts_with($du, 'data:')) {
      [$relPath, $_] = save_data_url_image($du);
      $pdo->prepare("INSERT INTO project_images (project_id, file_path, description, is_cover) VALUES (?,?,?,0)")
          ->execute([$pid, $relPath, ($desc!==''?$desc:null)]);
    } else {
      $filePath = ltrim(str_replace('/majaaz_portal/', '', $du), '/');
      $pdo->prepare("INSERT INTO project_images (project_id, file_path, description, is_cover) VALUES (?,?,?,0)")
          ->execute([$pid, $filePath, ($desc!==''?$desc:null)]);
    }
  }
  // If no cover set but images exist, promote first
  $hasCover = $pdo->prepare("SELECT COUNT(*) c FROM project_images WHERE project_id=? AND is_cover=1");
  $hasCover->execute([$pid]);
  if ((int)$hasCover->fetch()['c'] === 0) {
    $first = $pdo->prepare("SELECT id FROM project_images WHERE project_id=? ORDER BY id ASC LIMIT 1");
    $first->execute([$pid]);
    $row = $first->fetch();
    if ($row) {
      $pdo->prepare("UPDATE project_images SET is_cover=1 WHERE id=?")->execute([(int)$row['id']]);
    }
  }
  $pdo->commit();
} catch (Throwable $e) {
  $pdo->rollBack();
  json_out(["ok"=>false,"error"=>"Update failed: ".$e->getMessage()], 500);
}
json_out(["ok"=>true, "projects"=>api_projects($pdo)]);
