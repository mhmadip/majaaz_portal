<?php
require_once __DIR__ . "/../config.php";
require_csrf();
require_login();
if (($_SESSION['user']['role'] ?? '') !== 'jury') {
  json_out(["ok"=>false,"error"=>"Forbidden"], 403);
}

$data      = read_json();
$projectId = (string)($data['projectId'] ?? '');

// Accept both "p3" and "3" formats
$pid = 0;
if (preg_match('/^p(\d+)$/', $projectId, $m)) $pid = (int)$m[1];
else $pid = (int)$projectId;
if ($pid <= 0) json_out(["ok"=>false,"error"=>"Invalid projectId"], 400);

// Verify project exists
$check = $pdo->prepare("SELECT id FROM projects WHERE id=?");
$check->execute([$pid]);
if (!$check->fetch()) json_out(["ok"=>false,"error"=>"Project not found"], 404);

$scores = $data['scores'] ?? [];
if (!is_array($scores) || count($scores) < 1) {
  json_out(["ok"=>false,"error"=>"Scores required"], 400);
}

// Ensure scores are integers
$scores = array_map('intval', $scores);

$published = !empty($data['published']) ? 1 : 0;
$comment   = trim((string)($data['comment'] ?? ''));

// Draft: at least 1 score > 0
// Publish: all scores > 0 + comment required
$nonZero = array_filter($scores, function($v){ return $v > 0; });
if (count($nonZero) === 0) {
  json_out(["ok"=>false,"error"=>"Please rate at least one criterion"], 400);
}
if ($published) {
  foreach ($scores as $v) {
    if ($v === 0) json_out(["ok"=>false,"error"=>"Rate all criteria before publishing"], 400);
  }
  if ($comment === '') {
    json_out(["ok"=>false,"error"=>"Comment required before publishing"], 400);
  }
}

$raw     = array_sum($scores);
$juryId  = (int)$_SESSION['user']['id'];

$stmt = $pdo->prepare("
  INSERT INTO evaluations (project_id, jury_id, scores_json, raw_score, comment, published)
  VALUES (?, ?, ?, ?, ?, ?)
  ON DUPLICATE KEY UPDATE
    scores_json = VALUES(scores_json),
    raw_score   = VALUES(raw_score),
    comment     = VALUES(comment),
    published   = VALUES(published),
    saved_at    = CURRENT_TIMESTAMP
");

$stmt->execute([
  $pid,
  $juryId,
  json_encode($scores),
  $raw,
  $comment !== '' ? $comment : null,
  $published
]);

// Return updated evaluations so the frontend refreshes immediately
$evals = $pdo->query("
  SELECT e.*, u.name AS juryName
  FROM evaluations e
  JOIN users u ON u.id = e.jury_id
  ORDER BY e.id DESC
")->fetchAll();

$outEvals = [];
foreach ($evals as $e) {
  $s = json_decode($e['scores_json'], true);
  if (!is_array($s)) $s = [];
  $outEvals[] = [
    "id"        => "e"  . (int)$e['id'],
    "projectId" => "p"  . (int)$e['project_id'],
    "juryId"    => "u"  . (int)$e['jury_id'],
    "juryName"  => $e['juryName'],
    "scores"    => array_map('intval', $s),
    "rawScore"  => (int)$e['raw_score'],
    "comment"   => $e['comment'] ?? "",
    "published" => (int)$e['published'] === 1,
    "savedAt"   => strtotime($e['saved_at']) * 1000
  ];
}

json_out(["ok" => true, "evaluations" => $outEvals]);
