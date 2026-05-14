<?php
require_once __DIR__ . "/../config.php";

$sessionUser = $_SESSION['user'] ?? null;

// Normalize the session user — add "u" prefix to id so it matches
// juryId format used in evaluations ("u3" not 3)
$me = null;
if ($sessionUser) {
  $rawId = (int)$sessionUser['id'];
  $me = [
    "id"    => "u" . $rawId,   // ← MUST match juryId format in evaluations
    "name"  => $sessionUser['name'],
    "email" => $sessionUser['email'],
    "role"  => $sessionUser['role'],
  ];
  // Also keep raw int id in session for PHP-side use
}

/* ══ PROJECTS ══ */
$projects = $pdo->query("
  SELECT p.*,
    (SELECT file_path FROM project_images WHERE project_id=p.id AND is_cover=1 LIMIT 1) AS cover
  FROM projects p
  ORDER BY p.id DESC
")->fetchAll();

$imgs = $pdo->query("SELECT * FROM project_images WHERE is_cover=0 ORDER BY file_path ASC, id ASC")->fetchAll();
$imgByProject = [];
foreach ($imgs as $im) {
  $pid = (int)$im['project_id'];
  $imgByProject[$pid][] = [
    "dataUrl"  => "/majaaz_portal/" . $im['file_path'],
    "filename" => pathinfo($im['file_path'], PATHINFO_BASENAME),
    "desc"     => $im['description'] ?? ""
  ];
}

$outProjects = [];
foreach ($projects as $p) {
  $pid = (int)$p['id'];
  $outProjects[] = [
    "id"        => "p" . $pid,
    "name"      => $p['name'],
    "cover"     => $p['cover'] ? "/majaaz_portal/" . $p['cover'] : null,
    "images"    => $imgByProject[$pid] ?? [],
    "createdAt" => strtotime($p['created_at']) * 1000
  ];
}

/* ══ EVALUATIONS ══ */
$evals = $pdo->query("
  SELECT e.*, u.name AS juryName
  FROM evaluations e
  JOIN users u ON u.id = e.jury_id
  ORDER BY e.id DESC
")->fetchAll();

$outEvals = [];
foreach ($evals as $e) {
  $scores = json_decode($e['scores_json'], true);
  if (!is_array($scores)) $scores = [];
  $outEvals[] = [
    "id"        => "e"  . (int)$e['id'],
    "projectId" => "p"  . (int)$e['project_id'],
    "juryId"    => "u"  . (int)$e['jury_id'],
    "juryName"  => $e['juryName'],
    "scores"    => array_map('intval', $scores),
    "rawScore"  => (int)$e['raw_score'],
    "comment"   => $e['comment'] ?? "",
    "published" => (int)$e['published'] === 1,
    "savedAt"   => strtotime($e['saved_at']) * 1000
  ];
}

/* ══ USERS (admin only) ══ */
$users = [];
if ($sessionUser && ($sessionUser['role'] ?? '') === 'admin') {
  $rows = $pdo->query("SELECT id,name,email,role,password_plain,created_at FROM users ORDER BY id DESC")->fetchAll();
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
}

/* ══ CRITERIA ══ */
$criteriaPath = __DIR__ . "/../criteria.json";
$savedCriteria = null;
if (file_exists($criteriaPath)) {
  $raw = file_get_contents($criteriaPath);
  if ($raw) $savedCriteria = json_decode($raw, true);
}

json_out([
  "ok"          => true,
  "me"          => $me,
  "users"       => $users,
  "projects"    => $outProjects,
  "evaluations" => $outEvals,
  "csrfToken"   => csrf_token(),
  "criteria"    => $savedCriteria,
]);
