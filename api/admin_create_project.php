<?php
require_once __DIR__ . "/lib.php";
require_csrf();
require_admin();
$data = read_json();

$name = trim((string)($data['name'] ?? ''));
if ($name==='') json_out(["ok"=>false,"error"=>"Name required"], 400);

$cover = (string)($data['cover'] ?? '');
$images = $data['images'] ?? [];
if (!is_array($images)) $images = [];

$pdo->beginTransaction();
try {
  $stmt = $pdo->prepare("INSERT INTO projects (name) VALUES (?)");
  $stmt->execute([$name]);
  $projectId = (int)$pdo->lastInsertId();

  // Save cover first (if provided)
  if ($cover !== '') {
    [$relPath, $_] = save_data_url_image($cover);
    $pdo->prepare("INSERT INTO project_images (project_id, file_path, description, is_cover) VALUES (?,?,?,1)")
        ->execute([$projectId, $relPath, null]);
  }

  // Save other images
  foreach ($images as $im) {
    if (!is_array($im)) continue;
    $du = (string)($im['dataUrl'] ?? '');
    if ($du === '') continue;
    $desc = trim((string)($im['desc'] ?? ''));
    [$relPath, $_] = save_data_url_image($du);
    $pdo->prepare("INSERT INTO project_images (project_id, file_path, description, is_cover) VALUES (?,?,?,0)")
        ->execute([$projectId, $relPath, ($desc!==''?$desc:null)]);
  }

  // If no cover was provided but images exist, set the latest as cover
  $hasCover = $pdo->prepare("SELECT COUNT(*) c FROM project_images WHERE project_id=? AND is_cover=1");
  $hasCover->execute([$projectId]);
  if ((int)$hasCover->fetch()['c'] === 0) {
    $first = $pdo->prepare("SELECT id FROM project_images WHERE project_id=? ORDER BY id ASC LIMIT 1");
    $first->execute([$projectId]);
    $row = $first->fetch();
    if ($row) {
      $pdo->prepare("UPDATE project_images SET is_cover=1 WHERE id=?")->execute([(int)$row['id']]);
    }
  }

  $pdo->commit();
} catch (Throwable $e) {
  $pdo->rollBack();
  json_out(["ok"=>false,"error"=>"Create failed: ".$e->getMessage()], 500);
}

json_out(["ok"=>true, "projects"=>api_projects($pdo)]);
