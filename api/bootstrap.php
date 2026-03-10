<?php
require_once __DIR__ . "/../config.php";

$me = $_SESSION['user'] ?? null;

$projects = $pdo->query("
  SELECT p.*,
    (SELECT file_path FROM project_images WHERE project_id=p.id AND is_cover=1 LIMIT 1) AS cover
  FROM projects p
  ORDER BY p.id DESC
")->fetchAll();

$imgs = $pdo->query("SELECT * FROM project_images ORDER BY id DESC")->fetchAll();

// Map images to projects in the shape your UI expects: project.images = [{dataUrl|url, desc}]
$imgByProject = [];
foreach ($imgs as $im) {
  $pid = (int)$im['project_id'];
  $imgByProject[$pid] = $imgByProject[$pid] ?? [];
  $imgByProject[$pid][] = [
    "dataUrl" => "/majaaz_portal/" . $im['file_path'],
    "desc" => $im['description'] ?? ""
  ];
}

$outProjects = [];
foreach ($projects as $p) {
  $pid = (int)$p['id'];
  $outProjects[] = [
    "id" => "p".$pid,
    "name" => $p['name'],
    "cover" => $p['cover'] ? ("/majaaz_portal/" . $p['cover']) : null,
    "images" => $imgByProject[$pid] ?? [],
    "createdAt" => strtotime($p['created_at']) * 1000
  ];
}

$evals = $pdo->query("
  SELECT e.*, u.name AS juryName
  FROM evaluations e
  JOIN users u ON u.id=e.jury_id
  ORDER BY e.id DESC
")->fetchAll();

$outEvals = [];
foreach ($evals as $e) {
  $scores = json_decode($e['scores_json'], true);
  if (!is_array($scores)) $scores = [];
  $outEvals[] = [
    "id" => "e".$e['id'],
    "projectId" => "p".(int)$e['project_id'],
    "juryId" => "u".(int)$e['jury_id'],
    "juryName" => $e['juryName'],
    "scores" => $scores,
    "comment" => $e['comment'] ?? "",
    "published" => (int)$e['published'] === 1,
    "savedAt" => strtotime($e['saved_at']) * 1000
  ];
}

$users = [];
if ($me && ($me['role'] ?? '') === 'admin') {
  $rows = $pdo->query("SELECT id,name,email,role,created_at FROM users ORDER BY id DESC")->fetchAll();
  foreach ($rows as $u) {
    $users[] = [
      "id" => "u".(int)$u['id'],
      "email" => $u['email'],
      "role" => $u['role'],
      "name" => $u['name'],
      "createdAt" => strtotime($u['created_at']) * 1000
    ];
  }
}

json_out(["ok"=>true, "me"=>$me, "users"=>$users, "projects"=>$outProjects, "evaluations"=>$outEvals]);
